<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\SalesItem;
use Auth;

class SalesController extends Controller
{

    public function index(){
        $sales = Sales::with(['customer', 'salesItems.item', 'salesItems.size'])->get();
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        return view('page.sales-list.index', compact('sales', 'dateTime'));
    }

    public function store(Request $request)
    {
        $items = json_decode($request->items_id, true);

        // Create the Sale record
        $sale = Sales::create([
            'customer_id' => $request->customer_id,
            'total_price' => $request->subtotal,
            'payment_method' => $request->payment_type,
            'cashier_name' => Auth::user()->name,
            'date' => Carbon::now()->format('Y-m-d'),
            'time' => Carbon::now()->format('H:i:s'),
        ]);

        if ($items) {
            foreach ($items as $item) {
                // Debugging output to check the structure of $item
                Log::info('Item:', $item);

                // Validate the structure of $item
                if (!isset($item['item_id']) || !isset($item['prices'])) {
                    Log::error('Missing item_id or prices in item:', $item);
                    continue; // Skip this iteration if the structure is not as expected
                }

                // Create a new SalesItem
                SalesItem::create([
                    'sales_id' => $sale->id,
                    'item_id' => $item['item_id'],
                    'size_id' => $item['size_id'] ?? null, // Use null if size_id is not provided
                    'harga_items' => $item['prices'],
                ]);
            }
        }

        return response()->json(['success' => true, 'sale_id' => $sale->id]);
    }

    public function void(Request $request)
    {
        // Validate the admin credentials
        $admin = User::role('admin')->where('name', $request->name)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect()->back()->with('error', 'Invalid admin credentials.');
        }

        // Find the sale
        $sale = Sales::find($request->sale_id);
        if (!$sale || $sale->status == 'voided') {
            return redirect()->back()->with('error', 'Sale not found or already voided.');
        }

        // Duplicate the sale and mark as void
        $voidSale = $sale->replicate();
        $voidSale->status = 'voided';
        $voidSale->save();

        // Update the original sale to void
        $sale->status = '';
        $sale->save();

        return redirect()->back()->with('success', 'Sale voided successfully.');
    }

}
