<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')->orderByDesc('updated_at')->orderByDesc('created_at')->paginate(10);
        $totalCategories = Category::count();

        return view('admin.category.index', ['categories' => $categories, 'totalCategories' => $totalCategories]);
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
        $request->validate([
            "category_type" => "required|string|max:50|unique:categories,type",
            "category_description" => "nullable|max:255"
        ]);

        $category = Category::create([
            "type" => $request->category_type,
            "description" => $request->category_description
        ]);

        return back()->with("success", "Category '{$category->name}' has been added!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "category_type" => "required|string|max:50|unique:categories,type",
            "category_description" => "nullable|max:255"
        ]);

        $category = Category::find($id);

        if (!$category) {
            return back()->with('invalid', 'Category not found.');
        }

        $category->update([
            "type" => $request->category_type,
            "description" => $request->category_description
        ]);

        return back()->with('update', "Product '{$category->type}' has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}