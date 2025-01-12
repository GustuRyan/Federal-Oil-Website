<?php

namespace App\Http\Controllers;

use App\Models\Receivable;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    /**
     * Display a listing of receivables.
     */
    public function index()
    {
        $receivables = Receivable::with('customer')->get();
        return response()->json($receivables);
    }

    /**
     * Store a newly created receivable in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_cost' => 'required|numeric',
            'due_date' => 'required|date',
            'payment_status' => 'required|in:lunas,belum_lunas',
            'description' => 'nullable|string',
        ]);

        // Simpan data receivable
        $receivable = Receivable::create($validated);

        return response()->json([
            'message' => 'Receivable created successfully',
            'data' => $receivable,
        ], 201);
    }

    /**
     * Display the specified receivable.
     */
    public function show($id)
    {
        $receivable = Receivable::with('customer')->findOrFail($id);
        return response()->json($receivable);
    }

    /**
     * Update the specified receivable in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'total_cost' => 'sometimes|required|numeric',
            'due_date' => 'sometimes|required|date',
            'payment_status' => 'sometimes|required|in:lunas,belum_lunas',
            'description' => 'nullable|string',
        ]);

        // Temukan receivable dan update
        $receivable = Receivable::findOrFail($id);
        $receivable->update($validated);

        return response()->json([
            'message' => 'Receivable updated successfully',
            'data' => $receivable,
        ], 200);
    }

    /**
     * Remove the specified receivable from storage.
     */
    public function destroy($id)
    {
        $receivable = Receivable::findOrFail($id);
        $receivable->delete();

        return response()->json([
            'message' => 'Receivable deleted successfully',
        ], 200);
    }
}