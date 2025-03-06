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
    public function index(Request $request)
    {
        $query = Receivable::query();
        $searchTerm = $request->search ?? null;
        $statusTerm = $request->status ?? null;

        if (!empty($searchTerm)) {
            $query->whereHas('customer', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!empty($statusTerm) && $statusTerm != 'all') {
            $query->where('payment_status', $statusTerm);
        }

        $receivables = $query->paginate(10);
        return view('backviews.pages.receivable.index', compact(
            'receivables',
            'searchTerm',
            'statusTerm'
        ));
    }

    /**
     * Store a newly created receivable in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_cost' => 'required|numeric',
            'due_date' => 'required|date',
            'payment_status' => 'required|in:lunas,belum lunas',
            'description' => 'nullable|string',
        ]);

        $receivable = Receivable::create($validated);

        return redirect()->route('admin.receivables.index')->with('success', 'Piutang berhasil ditambahkan.');
    }

    public function create()
    {
        $customers = Customer::all();

        return view('backviews.pages.receivable.create', compact('customers'));
    }
    /**
     * Display the specified receivable.
     */
    public function edit($id)
    {
        $receivable = Receivable::findOrFail($id);
        $customers = Customer::all();

        return view('backviews.pages.receivable.update', compact('receivable', 'customers'));
    }

    /**
     * Update the specified receivable in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'total_cost' => 'sometimes|required|numeric',
            'due_date' => 'sometimes|required|date',
            'payment_status' => 'sometimes|required|in:lunas,belum lunas',
            'description' => 'nullable|string',
        ]);

        $receivable = Receivable::findOrFail($id);
        $receivable->update($validated);

        return redirect()->route('admin.receivables.index')->with('success', 'Piutang berhasil diperbarui.');
    }

    /**
     * Remove the specified receivable from storage.
     */
    public function destroy($id)
    {
        $receivable = Receivable::findOrFail($id);
        $receivable->delete();

        return redirect()->route('admin.receivables.index')->with('success', 'Piutang berhasil dihapus.');
    }
}