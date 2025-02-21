<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->with('category')->paginate(20);
        // $allProducts = Product::withTrashed()->get();

        // $products = Product::with('category')
        //     ->orderByRaw('ISNULL(deleted_at), deleted_at DESC') 
        //     ->orderByDesc('created_at')
        //     ->paginate(20);

        return view('admin.inventory.index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            "product_name" => "required|string|max:255",
            "product_category" => "required|exists:categories,id",
            "product_stock" => "required|integer|min:0",
            "product_original_price" => "required|numeric|min:0",
            "product_selling_price" => "required|numeric|min:0",
        ]);

        $product = Product::create([
            "name" => $request->product_name,
            "category_id" => $request->product_category,
            "stock" => $request->product_stock,
            "original_price" => $request->product_original_price,
            "selling_price" => $request->product_selling_price,
        ]);

        return back()->with("success", "Product '{$product->name}' has been added!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|exists:categories,id',
            'product_stock' => 'required|integer|min:0',
            'product_original_price' => 'required|numeric|min:0',
            'product_selling_price' => 'required|numeric|min:0',
        ]);

        // Fetch product using parameter ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return back()->with('invalid', 'Product not found.');
        }

        // Update product details
        $product->update([
            'name' => $request->product_name,
            'category_id' => $request->product_category,
            'stock' => $request->product_stock,
            'original_price' => $request->product_original_price,
            'selling_price' => $request->product_selling_price,
        ]);

        return back()->with('update', "Product '{$product->name}' has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return back()->with('success', "Product '{$product->name}' has been put in the bin!");
    }
}