<?php

namespace App\Http\Controllers;

use App\Charts\MonthlySpendChart;
use App\Charts\SpendingChart;
use App\Models\Spending;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SpendingController extends Controller
{
    /**
     * Display a listing of the spending records.
     */
    public function index(Request $request, MonthlySpendChart $chart, SpendingChart $spendChart)
    {
        $query = Spending::query();
        $searchTerm = $request->search ?? null;
        $typeTerm = $request->category ?? null;

        if (!empty($searchTerm)) {
            $query->where('distributor', 'like', '%' . $searchTerm . '%');
        }

        if (!empty($typeTerm) && $typeTerm !== 'all') {
            $query->where('spending_type', $typeTerm);
        }

        $currentDate = Carbon::now()->day;
        $totalDaysInMonth = Carbon::now()->daysInMonth;

        $formattedDate = $currentDate . '/' . $totalDaysInMonth;

        $amountSpend = Spending::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $amountSpendDay = Spending::whereDate('created_at', Carbon::now())->count();
        
        $totalSpend = Spending::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_cost');

        $totalSpendDay = Spending::where('created_at', Carbon::now())
            ->sum('total_cost');

        $cardResources = collect([
            [
                'title' => 'Jumlah Pengeluaran Bulan Ini',
                'value' => $amountSpend,
                'time' => $formattedDate
            ],
            [
                'title' => 'Total Nilai Pengeluaran Bulan Ini',
                'value' => $totalSpend,
                'time' => $formattedDate
            ],
            [
                'title' => 'Jumlah Pengeluaran Hari Ini',
                'value' => $amountSpendDay,
                'time' => $formattedDate
            ],
            [
                'title' => 'Total Nilai Pengeluaran Hari Ini',
                'value' => $totalSpendDay,
                'time' => $formattedDate
            ],
        ]);

        $chartData = $chart->build();
        $chartSpend = $spendChart->build();

        $spendings = $query->paginate(10);
        return view('backviews.pages.spending.index', compact(
            'spendings',
            'chartData',
            'chartSpend',
            'searchTerm',
            'cardResources'
        ));
    }

    /**
     * Store a newly created spending record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'spending_type' => 'required|in:biaya operasional,biaya suku cadang,gaji',
            'distributor' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'payment_methods' => 'required|in:tunai,kredit,transfer',
            'description' => 'nullable|string',
        ]);

        $spending = Spending::create($validated);

        return redirect()->route('admin.spending.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    /**
     * Display the specified spending record.
     */
    public function edit($id)
    {
        $spending = Spending::findOrFail($id);

        return view('backviews.pages.spending.update', compact('spending'));
    }

    /**
     * Update the specified spending record in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'spending_type' => 'sometimes|required|in:biaya operasional,biaya suku cadang,gaji',
            'distributor' => 'nullable|string',
            'total_cost' => 'sometimes|required|numeric',
            'payment_methods' => 'sometimes|required|in:tunai,kredit,transfer',
            'description' => 'nullable|string',
        ]);

        $spending = Spending::findOrFail($id);
        $spending->update($validated);

        return redirect()->route('admin.spending.index')->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    /**
     * Remove the specified spending record from storage.
     */
    public function destroy($id)
    {
        $spending = Spending::findOrFail($id);
        $spending->delete();

        return redirect()->route('admin.spending.index')->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
