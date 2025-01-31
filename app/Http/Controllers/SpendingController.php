<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    /**
     * Display a listing of the spending records.
     */
    public function index(Request $request)
    {
        $spendings = Spending::paginate(10);
        return view('backviews.pages.spending.index', compact('spendings'));
    }

    /**
     * Store a newly created spending record in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'spending_type' => 'required|in:biaya operasional,biaya suku cadang,gaji',
            'distributor' => 'nullable|string',
            'total_cost' => 'required|numeric',
            'payment_methods' => 'required|in:tunai,kredit,transfer',
            'description' => 'nullable|string',
        ]);

        // Simpan data spending
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

        // Temukan spending dan update
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
