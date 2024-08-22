<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\CouponItems;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
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
                    'final_price' => $validated['final_price'], // Fixing final_price assignment
                ]);
            }

            Log::info('Coupon created successfully:', ['coupon_id' => $coupon->id]);

            return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating coupon:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('System error: ' . $e->getMessage());
        }
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

    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'item_id' => 'nullable|exists:items,id',
            'expired_date' => 'required|date',
            'discount_value' => 'required|numeric',
            'discount_type' => 'required|in:percentage,fixed',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
