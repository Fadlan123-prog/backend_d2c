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

    public function index(Request $request){
        $date = $request->input('date', now()->format('Y-m-d'));

        $parseDate = Carbon::parse($date)->format('Y-m-d');

        // Jika tanggal dipilih, ambil penjualan berdasarkan tanggal tersebut
        $sales = Sales::whereDate('date', $parseDate)
            ->with(['customer', 'salesItems.item', 'salesItems.size'])
            ->get();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        return view('page.sales-list.index', compact('sales', 'dateTime'));
    }

    public function store(Request $request)
    {
        $items = json_decode($request->items_id, true);
        $couponId = $request->coupon_id;

        Log::info('Coupon ID:', [$request->coupon_id]);
        // Create the Sale record
        $sale = Sales::create([
            'customer_id' => $request->customer_id,
            'total_price' => $request->subtotal,
            'payment_method' => $request->payment_type,
            'cashier_name' => Auth::user()->name,
            'date' => Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'),
            'time' => Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s'),
        ]);

        Log::info('Items:', $items); // Debugging output to check the structure of $items (optional)

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
                    'coupon_id' => $couponId, // Use null if coupons_id is not provided
                    'harga_items' => $item['prices'],
                    'quantity' => $item['quantity'] ?? 1, // Use 1 if quantity is not provided
                ]);
            }
        }


        return response()->json(['success' => true, 'sale_id' => $sale->id]);
    }
    public function getReceipt($saleId)
    {
        $sale = Sales::with('salesItems.item', 'salesItems.size', 'customer')->findOrFail($saleId);

        $salesItems = $sale->salesItems->map(function ($salesItem) {
            return [
                'name' => $salesItem->item->items_name,
                'size' => $salesItem->size->size ?? '',
                'quantity' => $salesItem->quantity,
                'price' => $salesItem->harga_items,
            ];
        });

        return response()->json([
            'date' => $sale->date,
            'time' => $sale->time,
            'customer_plate' => $sale->customer->plate_number,
            'cashier' => $sale->cashier_name,
            'items' => $salesItems,
            'subtotal' => $sale->subtotal,
            'discount' => $sale->discount ?? 0,
            'total' => $sale->total_price,
        ]);
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
