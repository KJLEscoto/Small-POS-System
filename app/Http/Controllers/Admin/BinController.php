<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashedProducts = Product::onlyTrashed()->get();
        return view('admin.inventory.bin.index', ['archives' => $trashedProducts]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function restore(string $id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->firstOrFail();
        $product->restore();

        return back()->with('success', "Product '{$product->name}' has been restored!");
    }

    public function forceDelete(string $id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->firstOrFail();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->forceDelete();

        return back()->with('success', "Product '{$product->name}' has been permanently deleted!");
    }
}