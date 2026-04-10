<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with(['lendingDetails.lending' => function($q) {
            $q->where('status', 'borrowed');
        }])->get();
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'repair' => 'nullable|integer|min:0',
            'total_stock' => 'required|integer|min:0',
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'repair' => 0,
            'total_stock' => $request->total_stock,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showItemStaff()
    {
        $items = Item::all(); // Ambil semua barang
        return view('staff.items.index', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $items = Item::findOrFail($id);
        $categories = Category::all();

        return view('admin.items.edit', compact('categories', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'repair' => 'nullable|integer|min:0',
            'total_stock' => 'required|integer|min:0',
        ]);

        $newBroke = $request->new_broke_item ?? 0;
        $totalRepair = $item->repair + $newBroke;

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'repair' => $totalRepair,
            'total_stock' => $request->total_stock,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
