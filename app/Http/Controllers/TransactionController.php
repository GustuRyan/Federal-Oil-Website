<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Queue;
use App\Models\Customer;
use App\Models\Receivable;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\UserQueue;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Charts\MonthlyChart;
use App\Charts\RevenueChart;

class TransactionController extends Controller
{
  public function dashboard()
  {
    $customers = Customer::all();

    $today = now()->toDateString();
    $queue = Queue::whereDate('created_at', $today)->first();

    $products = Cart::where('product_id', '!=', null)->where('queue', $queue->current_queue)->get();
    $services = Cart::where('service_id', '!=', null)->where('queue', $queue->current_queue)->get();

    $userQueue = UserQueue::where('queue', $queue->current_queue)->first();

    return view('frontviews.index', compact('customers', 'products', 'services', 'userQueue'));
  }

  public function index(Request $request, MonthlyChart $chart, RevenueChart $revenueChart)
  {
    $query = Transaction::query();
    $searchTerm = $request->search ?? null;
    $methodTerm = $request->method ?? null;
    $statusTerm = $request->status ?? null;

    if (!empty($searchTerm)) {
      $query->where(function ($q) use ($searchTerm) {
        $q->where('invoice', 'like', '%' . $searchTerm . '%')
          ->orWhereHas('customer', function ($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%');
          });
      });
    }

    if (!empty($methodTerm) && $methodTerm != 'all') {
      $query->where('payment_methods', $methodTerm);
    }

    if (!empty($statusTerm) && $statusTerm != 'all') {
      $query->where('payment_status', $statusTerm);
    }

    if (!empty($request->sort) && in_array($request->sort, ['asc', 'desc'])) {
      $query->orderBy('total_cost', $request->sort);
    }

    $currentDate = Carbon::now()->day;
    $totalDaysInMonth = Carbon::now()->daysInMonth;

    $formattedDate = $currentDate . '/' . $totalDaysInMonth;

    $totalAmount = TransactionDetail::whereNull('service_id')
      ->whereNotNull('product_id')
      ->whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)
      ->sum('amount');

    $totalAmountDay = TransactionDetail::whereNull('service_id')
      ->whereNotNull('product_id')
      ->where('created_at', Carbon::now())
      ->sum('amount');

    $totalIncome = Transaction::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)
      ->sum('total_cost');

    $totalIncomeDay = Transaction::where('created_at', Carbon::now())
      ->sum('total_cost');

    $cardResources = collect([
      [
        'title' => 'Total Item Keluar Bulan Ini',
        'value' => $totalAmount,
        'time' => $formattedDate
      ],
      [
        'title' => 'Total Pendapatan Bulan Ini',
        'value' => $totalIncome,
        'time' => $formattedDate
      ],
      [
        'title' => 'Total Item Keluar Hari Ini',
        'value' => $totalAmountDay,
        'time' => $formattedDate
      ],
      [
        'title' => 'Total Pendapatan Hari Ini',
        'value' => $totalIncomeDay,
        'time' => $formattedDate
      ],
    ]);

    // Pagination
    $transactions = $query->paginate(10);

    // Generate chart data
    $chartData = $chart->build();
    $chartRevenue = $revenueChart->build();

    return view('backviews.pages.income.index', compact(
      'transactions',
      'searchTerm',
      'chartData',
      'chartRevenue',
      'cardResources'
    ));
  }

  public function edit($id)
  {
    $transaction = Transaction::findOrFail($id);
    $customers = Customer::all();

    return view('backviews.pages.income.update', compact('transaction', 'customers'));
  }

  public function detail($id)
  {
    $products = TransactionDetail::where('transaction_id', $id)->where('product_id', '!=', null)->get();
    $services = TransactionDetail::where('transaction_id', $id)->where('service_id', '!=', null)->get();

    $totalCostProduct = 0;
    $totalCostService = 0;

    foreach ($products as $product) {
      $totalCostProduct = $totalCostProduct + ($product->product->selling_price * $product->amount);
    }

    foreach ($services as $service) {
      $totalCostService = $totalCostService + $service->service->service_price;
    }

    return view('backviews.pages.income.detail', compact('products', 'services', 'totalCostProduct', 'totalCostService'));
  }

  public function store(Request $request)
  {
    // dd($request->all());

    $request->validate([
      'invoice' => 'required|string|max:255|unique:transactions,invoice',
      'customer_id' => 'required|integer',
      'total_cost' => 'required|numeric|min:0',
      'payment_methods' => 'required|in:tunai,kredit,transfer',
      'payment_status' => 'required|in:lunas,belum lunas',
      'description' => 'nullable|string',
    ]);

    $today = now()->toDateString();
    $queue = Queue::whereDate('created_at', $today)->first();

    if ($queue) {
      $queueList = $queue->queue_list;

      if (is_string($queueList)) {
        $queueList = json_decode($queueList, true);
      }

      if (is_array($queueList) && $queue->current_queue) {
        $queueList = array_filter($queueList, function ($item) use ($queue) {
          return $item !== $queue->current_queue;
        });

        $queueList = array_values($queueList);

        if (!in_array($queue->current_queue + 1, $queueList)) {
          $queueList[] = $queue->current_queue + 1;
        }
      }

      $latestQueue = $queue->last_queue;

      if ($queue->current_queue == $queue->last_queue) {
        $latestQueue = $queue->last_queue + 1;
      }

      $updateQueue = [
        'current_queue' => $queue->current_queue + 1,
        'queue_list' => $queueList,
        'last_queue' => $latestQueue,
      ];

      $queue->update($updateQueue);
    } else {
      $updateQueue = [
        'current_queue' => 2,
        'queue_list' => [2],
        'last_queue' => 2,
      ];

      $queue = Queue::create($updateQueue);
    }

    $transaction = Transaction::create($request->all());
    $carts = Cart::all();

    if ($transaction->payment_status == "belum lunas") {
      $dueDate = Carbon::now()->addDays(3);

      $addReceivable = [
        'customer_id' => $transaction->customer_id,
        'total_cost' => $transaction->total_cost,
        'due_date' => $dueDate,
        'payment_status' => $transaction->payment_status,
        'description' => $transaction->description,
      ];

      $receivable = Receivable::create($addReceivable);
    }

    foreach ($carts as $cart) {
      $addTransDetail = [
        'transaction_id' => $transaction->id,
        'product_id' => $cart->product_id,
        'amount' => $cart->amount,
        'service_id' => $cart->service_id,
        'service_time' => $cart->service_time,
      ];

      if ($cart->product_id) {
        $updateStock = ['latest_stock' => $cart->product->latest_stock - $cart->amount];

        $product = Product::findOrFail($cart->product_id);
        $product->update($updateStock);
      }

      $transDetail = TransactionDetail::create($addTransDetail);
    }

    Cart::truncate();

    return redirect()->route('cashier')->with([
      'success' => 'Transaksi berhasil ditambahkan.',
      'invoice_url' => route('invoice.pdf', $transaction->id),
    ]);
  }

  // Update
  public function update(Request $request, $id)
  {
    $transaction = Transaction::findOrFail($id);

    $request->validate([
      'invoice' => 'required|string|max:255|unique:transactions,invoice,' . $transaction->id,
      'customer_id' => 'required|exists:customers,id',
      'total_cost' => 'required|numeric|min:0',
      'payment_methods' => 'required|in:tunai,kredit,transfer',
      'payment_status' => 'required|in:lunas,belum lunas',
      'description' => 'nullable|string',
    ]);

    $transaction->update($request->all());

    return redirect()->route('admin.income.index')->with('success', 'Transaksi berhasil diperbarui.');
  }

  // Delete
  public function destroy($id)
  {
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return redirect()->route('admin.income.index')->with('success', 'Transaksi berhasil dihapus.');
  }
}
