<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(request $request)
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function show()
    {
        $categories = Category::all();

        return view('Categories.data_category', compact('categories'));
    }

    public function create_category(request $category)
    {
        $category->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $category->name,
        ]);

        return redirect()->route('categories')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show_create_category()
    {
        $categories = Category::all();
        return view('Categories.create_category', compact('categories'));
    }

    public function show_edit_category(Category $category)
    {
        $categories = Category::all();
        return view('Categories.edit_category', compact('category', 'categories'));
    }

    public function edit_category(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy_category($id)
    {

        $category = Category::findOrFail($id);

        if ($category->item()->exists()) {
            return redirect()->route('categories')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki item.');
        }


        $category->delete();

        return redirect()->route('categories')
            ->with('success', 'Kategori berhasil dihapus');
    }


}
