<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Spending;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\View;
use App\Charts\MonthlyChart;
use App\Charts\RevenueChart;
use App\Charts\MonthlySpendChart;
use App\Charts\SpendingChart;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index(MonthlyChart $chart, RevenueChart $revenueChart, MonthlySpendChart $chart1, SpendingChart $spendChart)
    {

        $currentDate = Carbon::now()->day;
        $totalDaysInMonth = Carbon::now()->daysInMonth;

        $formattedDate = $currentDate . '/' . $totalDaysInMonth;

        $totalAmount = TransactionDetail::whereNull('service_id')
            ->whereNotNull('product_id')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $totalStock = Product::sum('latest_stock');

        $amountPercentage = $totalStock > 0 ? number_format(($totalAmount / $totalStock * 100), 2) : 0;
        $amountPercentage = $amountPercentage . '%';

        $totalIncome = Transaction::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_cost');

        $totalSpend = Spending::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_cost');

        $cardResources = collect([
            [
                'color' => 'bg-[#FFE2E6]',
                'title' => 'Total Item Keluar',
                'value' => $totalAmount,
                'time' => $amountPercentage
            ],
            [
                'color' => 'bg-[#E9F1FE]',
                'title' => 'Total Pendapatan Bulan Ini',
                'value' => $totalIncome,
                'time' => $formattedDate
            ],
            [
                'color' => 'bg-[#FFEDEF]',
                'title' => 'Total Pengeluaran Bulan Ini',
                'value' => $totalSpend,
                'time' => $formattedDate
            ],
        ]);

        $chartData = $chart->build();
        $chartRevenue = $revenueChart->build();
        $spendData = $chart1->build();
        $chartSpend = $spendChart->build();

        return view('backviews.pages.index', compact('chartData', 'chartRevenue', 'spendData', 'chartSpend', 'cardResources'));
    }

    public function generatePDF($id)
    {
        $transaction = Transaction::findOrFail($id);
        $products = TransactionDetail::where('transaction_id', $id)
            ->whereNotNull('product_id')
            ->get();

        $services = TransactionDetail::where('transaction_id', $id)
            ->whereNotNull('service_id')
            ->get();

        $data = [
            'company' => 'PT Kledo Berhati Nyaman',
            'invoice_no' => $transaction->invoice,
            'date' => '21/07/2020',
            'due_date' => '23/07/2020',
            'customer' => [
                'name' => $transaction->customer->name,
                'address' => $transaction->customer->address,
                'phone' => $transaction->customer->phone_number,
                'email' => $transaction->customer->email,
            ],
            'products' => $products->map(function ($product) {
                return [
                    'name' => $product->product->product_name ?? 'N/A',
                    'description' => $product->product->description ?? '-',
                    'quantity' => $product->amount,
                    'price' => $product->product->selling_price,
                    'discount' => 0,
                    'tax' => 11,
                    'total' => $product->product->selling_price * $product->amount,
                ];
            })->toArray(),
            'services' => $services->map(function ($service) {
                return [
                    'name' => $service->service->service_name ?? 'N/A',
                    'description' => $service->service->description ?? '-',
                    'quantity' => $service->service_time . ' menit',
                    'price' => $service->service->service_price,
                    'discount' => 0,
                    'tax' => 11,
                    'total' => $service->service->service_price,
                ];
            })->toArray(),
            'subtotal' => round($transaction->total_cost, 2),
            'total' => $transaction->total_cost,
            'bank' => 'XXXXXXXX BCA a/n PT. ABC',
        ];

        $pdf = PDF::loadView('invoice', $data)
            ->setOption('page-width', '80mm')  
            ->setOption('page-height', '200mm') 
            ->setOption('orientation', 'portrait'); 

        return $pdf->download('invoice.pdf');
    }
}