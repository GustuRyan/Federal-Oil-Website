<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    // Create or update a cart
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'service_id' => 'nullable|exists:services,id',
            'amount' => 'nullable|integer|min:1',
            'service_time' => 'nullable|integer',
        ]);

        // Ensure only one of product_id or service_id is filled
        if (!empty($validated['product_id']) && !empty($validated['service_id'])) {
            return response()->json(['error' => 'Only one of product_id or service_id can be filled.'], 400);
        }

        if (!empty($validated['product_id'])) {
            // Check if the product already exists in the cart
            $cart = Cart::where('product_id', $validated['product_id'])->first();
            if ($cart) {
                // Update amount if the product exists
                $cart->amount += 1;
                $cart->save();

                return response()->json(['message' => 'Cart updated successfully.', 'cart' => $cart]);
            }

            // Create a new cart for the product
            $validated['service_id'] = null; // Ensure service_id is null
        } elseif (!empty($validated['service_id'])) {
            $validated['product_id'] = null; // Ensure product_id is null
        }

        $cart = Cart::create($validated);

        return response()->json(['message' => 'Cart created successfully.', 'cart' => $cart]);
    }

    // Update a cart
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found.'], 404);
        }

        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'service_id' => 'nullable|exists:services,id',
            'amount' => 'nullable|integer|min:1',
            'service_time' => 'nullable|integer',
        ]);

        // Ensure only one of product_id or service_id is filled
        if (!empty($validated['product_id']) && !empty($validated['service_id'])) {
            return response()->json(['error' => 'Only one of product_id or service_id can be filled.'], 400);
        }

        if (!empty($validated['product_id'])) {
            $validated['service_id'] = null; // Ensure service_id is null
        } elseif (!empty($validated['service_id'])) {
            $validated['product_id'] = null; // Ensure product_id is null
        }

        $cart->update($validated);

        return response()->json(['message' => 'Cart updated successfully.', 'cart' => $cart]);
    }

    // Delete a cart
    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['error' => 'Cart not found.'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully.']);
    }
}
