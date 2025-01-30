<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Queue;
use App\Models\Customer;
use App\Models\Receivable;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
  public function dashboard()
  {
    $customers = Customer::all();
    $products = Cart::where('product_id', '!=', null)->get();
    $services = Cart::where('service_id', '!=', null)->get();

    return view('frontviews.index', compact('customers', 'products', 'services'));
  }

  public function index(Request $request)
  {
    $query = Transaction::query();
    $searchTerm = null;

    if ($request->has('search') && !empty($request->search)) {
      $searchTerm = $request->search;
      $query->where('invoice', 'like', '%' . $searchTerm . '%');
    }

    $transactions = $query->paginate(10);

    return view('backviews.pages.income.index', compact('transactions', 'searchTerm'));
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
