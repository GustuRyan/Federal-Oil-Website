<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Queue;

class CartController extends Controller
{
    // Create or update a cart
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'service_id' => 'nullable|exists:services,id',
            'amount' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:1',
            'service_time' => 'nullable|integer',
        ]);

        $today = now()->toDateString();
        $queue = Queue::whereDate('created_at', $today)->first();
        
        $validated['queue'] = $queue ? $queue->current_queue : 1;

        // Ensure only one of product_id or service_id is filled
        if (!empty($validated['product_id']) && !empty($validated['service_id'])) {
            return response()->json(['error' => 'Only one of product_id or service_id can be filled.'], 400);
        }

        if (!empty($validated['product_id'])) {
            // Check if the product already exists in the cart
            $cart = Cart::where('product_id', $validated['product_id'])->where('queue', $validated['queue'])->first();
            if ($cart) {
                // Update amount if the product exists
                $cart->amount += 1;
                $cart->save();

                return redirect()->route('cashier')->with([
                    'success' => 'Keranjang berhasil ditambahkan.',
                    'scroll' => true,
                ]);
            }

            // Create a new cart for the product
            $validated['service_id'] = null; // Ensure service_id is null
        } elseif (!empty($validated['service_id'])) {
            $validated['product_id'] = null; // Ensure product_id is null
        }

        $cart = Cart::create($validated);

        return redirect()->route('cashier')->with([
            'success' => 'Keranjang berhasil ditambahkan.',
            'scroll' => true,
        ]);
    }

    // Update a cart
    public function update(Request $request, $id)
    {
        // Cari data cart berdasarkan ID
        $cart = Cart::find($id);

        // Jika cart tidak ditemukan, kembalikan respons error
        if (!$cart) {
            return response()->json(['error' => 'Cart not found.'], 404);
        }

        // Validasi hanya untuk amount dan service_time
        $validated = $request->validate([
            'amount' => 'nullable|integer|min:1',
            'price' => 'nullable|integer|min:1',
            'service_time' => 'nullable|integer',
        ]);

        // Update hanya field yang divalidasi
        $cart->update($validated);

        return redirect()->route('cashier')->with([
            'success' => 'Keranjang berhasil diperbarui.',
            'scroll' => true,
        ]);
    }


    // Delete a cart
    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found.'], 404);
        }

        $cart->delete();

        return redirect()->route('cashier')->with([
            'success' => 'Keranjang berhasil dihapus.',
            'scroll' => true,
        ]);
    }
}
