<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Admin;
use App\Models\Category;
use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function item(Request $request)
    {
        $items = Item::with('category')->get()->map(function ($item) {
            $item->image_url = Storage::url($item->image);
            return $item;
        });

        return response()->json($items);
    }



    public function show()
    {
        $items = Item::all();
        return view('Items.data_item', compact('items'));
    }

    public function show_report()
    {
        $items = Item::all();

        return view('Items.report_item', compact('items'));
    }

    public function create_item(request $item)
    {
        $item->validate([
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'total' => 'required',
            'admin_id' => 'required',
            'category_id' => 'required',
            'image' => 'required',
        ]);
        $image = $item->file('image')->store('images/items', 'public');
        Item::create([
            'name' => $item->name,
            'stock' => $item->stock,
            'total' => $item->total,
            'description' => $item->description,
            'admin_id' => $item->admin_id,
            'category_id' => $item->category_id,
            'image' => $image,
        ]);

        return redirect()->route('items')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show_create_item(request $requst)
    {
        // $admins = Admin::all();
        $categories = Category::all();
        return view('Items.create_item', compact('categories'));
    }

    public function edit_item(Request $request, Item $item)
    {
        $item->name = $request->name;
        $item->description = $request->description;
        $item->stock = $request->stock;
        $item->total = $request->total;
        $item->category_id = $request->category_id;
        $item->admin_id = $request->admin_id;

        if ($request->file('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }

            $image = $request->file('image')->store('images/items', 'public');
            $item->image = $image;
        }

        $item->save();
        return redirect()->route('items')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function show_edit_item(Item $item)
    {
        // $admins = Admin::all();
        $categories = Category::all();
        return view('Items.edit_item', compact('item','categories'));
    }

    public function destroy_item($id)
    {
        $item = Item::findOrFail($id);

        $hasActiveLoans = $item->loan()
            ->whereIn('status', ['ditunda', 'disetujui'])
            ->exists();

        if ($hasActiveLoans) {
            return redirect()->route('items')
                ->with('error', 'Barang tidak bisa dihapus karena sedang dalam proses peminjaman.');
        }

        Storage::disk('public')->delete($item->image);

        $item->delete();

        return redirect()->route('items')
            ->with('success', 'Barang berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
    }


}
