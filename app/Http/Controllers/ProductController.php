<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'product_code' => 'required|integer|unique:product,product_code',
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string',
            'brand' => 'nullable|string',
            'model' => 'required|string',
            'first_stocks' => 'required|integer',
            'latest_stock' => 'required|integer',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'unit_type' => 'required|string',
            'in_date' => 'required|date',
            'expired_date' => 'nullable|date',
            'description' => 'nullable|string',
            'shelf_location' => 'nullable|string',
        ]);

        // Simpan data product
        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'product_code' => 'sometimes|required|integer|unique:product,product_code,' . $id,
            'product_name' => 'sometimes|required|string|max:255',
            'product_category' => 'sometimes|required|string',
            'brand' => 'nullable|string',
            'model' => 'sometimes|required|string',
            'first_stocks' => 'sometimes|required|integer',
            'latest_stock' => 'sometimes|required|integer',
            'buying_price' => 'sometimes|required|numeric',
            'selling_price' => 'sometimes|required|numeric',
            'unit_type' => 'sometimes|required|string',
            'in_date' => 'sometimes|required|date',
            'expired_date' => 'nullable|date',
            'description' => 'nullable|string',
            'shelf_location' => 'nullable|string',
        ]);

        // Temukan produk dan update
        $product = Product::findOrFail($id);
        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ], 200);
    }
}