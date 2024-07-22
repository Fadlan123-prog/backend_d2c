<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Size;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::with('sizes')->get();
        return view('page.item-list.index', compact('items'));
    }

    public function create()
    {
        $categories = Categories::all();
        $sizes = Size::all();

        return view('page.item-list.create', compact('categories', 'sizes'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'item.items_name' => 'required|string|max:255',
            'item.harga_item' => 'nullable|numeric',
            'item.category_id' => 'required|exists:categories,id',
            'sizes.*.size_id' => 'nullable|exists:sizes,id',
            'sizes.*.price' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Create the new item
            $item = new Item();
            $item->items_name = $validatedData['item']['items_name'];
            $item->harga_item = $validatedData['item']['harga_item'] ?? null;
            $item->category_id = $validatedData['item']['category_id'];
            $item->save();

            // Attach sizes to the item if sizes are provided
            if (isset($validatedData['sizes'])) {
                foreach ($validatedData['sizes'] as $size) {
                    $item->sizes()->attach($size['size_id'], ['price' => $size['price']]);
                }
            }

            DB::commit();

            return redirect()->route('items.list.index')->with('success', 'Item berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('items.list.index')->withErrors(['error' => 'Terjadi kesalahan saat menyimpan item: '])->withInput();
        }
    }

    public function edit(Item $item)
{
    $categories = Categories::all();
    $sizes = Size::all();
    return view('page.item-list.edit', compact('item', 'categories', 'sizes'));
}

public function update(Request $request, Item $item)
{
    $request->validate([
        'item.items_name' => 'required|string|max:255',
        'item.category_id' => 'required|exists:categories,id',
        'item.harga_item' => 'nullable|numeric',
        'sizes' => 'nullable|array',
        'sizes.*.size_id' => 'required_with:sizes|exists:sizes,id',
        'sizes.*.price' => 'required_with:sizes|numeric'
    ]);

    $item->update($request->item);

    if ($request->has('sizes')) {
        $item->sizes()->sync([]);
        foreach ($request->sizes as $size) {
            $item->sizes()->attach($size['size_id'], ['price' => $size['price']]);
        }
    }

    return redirect()->route('items.list.index')->with('success', 'Item updated successfully');
    }

    public function destroy($id)
    {
        $item = Item::find($id);
    if ($item) {
        $item->delete();
        return redirect()->route('items.list.index')->with('success', 'Item deleted successfully');
    }
    return redirect()->route('items.list.index')->with('error', 'Item not found');
    }


}
