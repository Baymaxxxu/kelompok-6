<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')
            ->orderBy('id', 'asc')
            ->get();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:150',
            'unit' => 'required|max:50',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Barang bantuan berhasil ditambahkan.');
    }

    public function edit(Item $item)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:150',
            'unit' => 'required|max:50',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        $item->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Barang bantuan berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang bantuan berhasil dihapus.');
    }
}