<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Queue;

class CartController extends Controller
{
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

        if (!$queue) {
            $updateQueue = [
                'current_queue' => 1,
                'queue_list' => [1, 2],
                'last_queue' => 2,
            ];

            $queue = Queue::create($updateQueue);
        }

        if (!empty($validated['product_id']) && !empty($validated['service_id'])) {
            return response()->json(['error' => 'Only one of product_id or service_id can be filled.'], 400);
        }

        if (!empty($validated['product_id'])) {
            $cart = Cart::where('product_id', $validated['product_id'])->where('queue', $validated['queue'])->first();
            if ($cart) {
                $cart->amount += 1;
                $cart->save();

                return redirect()->route('cashier')->with([
                    'success' => 'Keranjang berhasil ditambahkan.',
                    'scroll' => true,
                ]);
            }

            $validated['service_id'] = null;
        } elseif (!empty($validated['service_id'])) {
            $validated['product_id'] = null;
        }

        $cart = Cart::create($validated);

        return redirect()->route('cashier')->with([
            'success' => 'Keranjang berhasil ditambahkan.',
            'scroll' => true,
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found.'], 404);
        }

        $validated = $request->validate([
            'amount' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:1',
            'service_time' => 'nullable|integer',
        ]);

        $cart->update($validated);

        return redirect()->route('cashier')->with([
            'success' => 'Keranjang berhasil diperbarui.',
            'scroll' => true,
        ]);
    }

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
