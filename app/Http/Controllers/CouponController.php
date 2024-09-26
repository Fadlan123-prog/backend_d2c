<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\CouponItems;
use App\Models\Item;
use App\Models\Size;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::with('items', 'category')->get();
        return view('page.coupon.index', compact('coupons'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('page.coupon.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'discount_amount' => 'nullable|numeric',
            'discount_percentage' => 'nullable|numeric',
            'expired_date' => 'required|date',
            'items' => 'required',
            'items.*' => 'exists:items,id',
            'size_id' => 'nullable|exists:sizes,id',
            'original_price' => 'numeric', // Added 'original_price'
            'final_price' => 'numeric',
        ]);

        if ($validated['discount_amount'] && $validated['discount_percentage']) {
            return redirect()->back()->withErrors('Only one of discount amount or percentage should be filled.');
        }

        try {
            Log::info('Validated data:', $validated);

            $coupon = Coupon::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'discount_amount' => $validated['discount_amount'],
                'discount_percentage' => $validated['discount_percentage'],
                'expired_date' => $validated['expired_date'],
            ]);

            foreach ($validated['items'] as $item_id) {
                CouponItems::create([
                    'coupon_id' => $coupon->id,
                    'item_id' => $item_id,
                    'size_id' => $validated['size_id'] ?? null,
                    'original_price' => $validated['original_price'] ?? null, // Added 'original_price'
                    'final_price' => $validated['final_price'] ?? null, // Fixing final_price assignment
                ]);
            }

            Log::info('Coupon created successfully:', ['coupon_id' => $coupon->id]);

            return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating coupon:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('System error: ' . $e->getMessage());
        }
    }

    public function getCoupons($coupon)
{
    // Find the coupon by its ID
    $coupon = Coupon::findOrFail($coupon);

    // Return response in JSON format
    return response()->json([
        'id' => $coupon->id,
        'name' => $coupon->name,
        'discount_amount' => $coupon->discount_amount,
        'discount_percentage' => $coupon->discount_percentage,
        'items' => $coupon->couponItems->map(function($couponItem) {
            return [
                'id' => $couponItem->item_id,  // Item ID from coupon items
                'size_id' => $couponItem->size_id,  // Include size if necessary
                'final_price' => $couponItem->final_price,
                'original_price' => $couponItem->item->price ?? null, // Assuming item has a price
                'item_name' => $couponItem->item->name ?? 'Unknown Item', // Assuming item has a name
            ];
        }),
    ]);
}

    public function getItemsByCategory($categoryId)
    {
        // Fetch items based on the categoryId
        $items = Item::where('category_id', $categoryId)
        ->with(['sizes' => function($query) {
            $query->withPivot('price');
        }])
        ->get();

        return response()->json(['items' => $items]);
    }

    public function edit($id)
    {
        $coupon = Coupon::with('items')->findOrFail($id);
        $categories = Categories::all();
        $items = Item::all();
        $sizes = Size::all();

        return view('page.coupon.edit', compact('coupon', 'categories', 'items', 'sizes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'discount_amount' => 'nullable|numeric',
            'discount_percentage' => 'nullable|numeric',
            'expired_date' => 'required|date',
            'items' => 'required|array',
            'items.*' => 'exists:items,id',
            'size_id' => 'nullable|exists:sizes,id',
            'final_price' => 'numeric|nullable',
        ]);

        if ($validated['discount_amount'] && $validated['discount_percentage']) {
            return redirect()->back()->withErrors('Only one of discount amount or percentage should be filled.');
        }

        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'discount_amount' => $validated['discount_amount'],
            'discount_percentage' => $validated['discount_percentage'],
            'expired_date' => $validated['expired_date'],
        ]);

        $coupon->items()->sync([]);
        foreach ($validated['items'] as $item_id) {
            $coupon->items()->attach($item_id, [
                'size_id' => $validated['size_id'] ?? null,
                'final_price' => $validated['final_price'] ?? null,
            ]);
        }

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->items()->detach();
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
