<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        $customers = Customer::paginate(10);
        return view('backviews.pages.customer.index', compact('customers'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|unique:customers,phone_number',
            'email' => 'required|email|unique:customers,email',
            'motorcycle_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Simpan data customer
        $customer = Customer::create($validated);

        return redirect()->route('admin.customer.index')->with('success', 'Pelanggan baru berhasil ditambahkan.');
    }
    
    public function storeDashboard(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|unique:customers,phone_number',
            'email' => 'required|email|unique:customers,email',
            'motorcycle_type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Simpan data customer
        $customer = Customer::create($validated);

        return redirect()->route('cashier')->with('success', 'Pelanggan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified customer.
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backviews.pages.customer.update', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'phone_number' => 'sometimes|required|string|unique:customers,phone_number,' . $id,
            'email' => 'sometimes|required|email|unique:customers,email,' . $id,
            'motorcycle_type' => 'sometimes|required|string',
            'description' => 'nullable|string',
        ]);

        // Temukan customer dan update
        $customer = Customer::findOrFail($id);
        $customer->update($validated);

        return redirect()->route('admin.customer.index')->with('success', 'Pelanggan baru berhasil diperbarui.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customer.index')->with('success', 'Pelanggan baru berhasil dihapus.');
    }
}