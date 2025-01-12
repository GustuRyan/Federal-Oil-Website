<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    /**
     * Display a listing of the spending records.
     */
    public function index()
    {
        $spendings = Spending::all();
        return response()->json($spendings);
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

        return response()->json([
            'message' => 'Spending created successfully',
            'data' => $spending,
        ], 201);
    }

    /**
     * Display the specified spending record.
     */
    public function show($id)
    {
        $spending = Spending::findOrFail($id);
        return response()->json($spending);
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

        return response()->json([
            'message' => 'Spending updated successfully',
            'data' => $spending,
        ], 200);
    }

    /**
     * Remove the specified spending record from storage.
     */
    public function destroy($id)
    {
        $spending = Spending::findOrFail($id);
        $spending->delete();

        return response()->json([
            'message' => 'Spending deleted successfully',
        ], 200);
    }
}
