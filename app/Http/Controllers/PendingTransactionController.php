<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\PendingTransaction;
use App\Models\PendingItem;
use App\Models\Coupon;
use App\Models\Item;
use Log;

use Illuminate\Http\Request;

class PendingTransactionController extends Controller
{
    public function index(Request $request){
        $date = $request->input('date', now()->format('Y-m-d'));

        $parseDate = Carbon::parse($date)->format('Y-m-d');

        $categories = Categories::all();
        $customers = Customer::all();
        $pendingTransaction = PendingTransaction::whereDate('date', $parseDate)
        ->with('customer', 'pendingItems.item', 'pendingItems.size')
        ->get();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('page.pending_transaction.index', compact('categories', 'customers', 'dateTime', 'pendingTransaction'));
    }

    public function store(Request $request)
    {
            // Decode the JSON data
            $items = json_decode($request->items_id, true);
            $coupons = $request->coupon_id;


            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON decoding error: ' . json_last_error_msg());
                return response()->json(['error' => 'Invalid items_id data'], 400);
            }

            // Create a new pending transaction entry
            $pendingTransaction = new PendingTransaction();
            $pendingTransaction->customer_id = $request->customer_id;
            $pendingTransaction->date = now()->format('Y-m-d');
            $pendingTransaction->time = now()->format('H:i:s');
            $pendingTransaction->cashier_name = auth()->user()->name; // Assume cashier is the logged in user
            $pendingTransaction->total_price = $request->subtotal ?? null;
            $pendingTransaction->payment_method = $request->payment_type ?? null;
            $pendingTransaction->save();


            if ($items) {
                foreach ($items as $item) {
                    // Debugging output to check the structure of $item
                    Log::info('Item:', $item);

                    // Validate the structure of $item
                    if (!isset($item['item_id']) || !isset($item['prices'])) {
                        Log::error('Missing item_id or prices in item:', $item);

                    }

                    // Create a new SalesItem
                    PendingItem::create([
                        'pending_transaction_id' => $pendingTransaction->id,
                        'item_id' => $item['item_id'],
                        'size_id' => $item['size_id'] ?? null, // Use null if size_id is not provided
                        'harga_items' => $item['prices'],
                        'coupon_id' => $coupons, // Use null if coupon_id is not provided
                        'quantity' => $item['quantity'] ?? 1, // Use null if quantity is not provided
                    ]);
                }
            }
            // Create pending_transaction_item entries

            return response()->json(['success' => true, 'pending_transaction_id' => $pendingTransaction->id]);
    }

    public function getItem($categoryId)
    {
        // Fetch items based on category ID
        $items = Item::where('category_id', $categoryId)->with('sizes')->get();

        // Return items as JSON response
        return response()->json($items);
    }

    public function getPendingTransaction($id)
    {
        try {
            $pendingTransaction = PendingTransaction::find($id);

            if (!$pendingTransaction) {
                return response()->json(['error' => 'Transaction not found'], 404);
            }

            return response()->json($pendingTransaction);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCoupon($id){
        $coupon = Coupon::with('items')->findOrFail($id);

        return response()->json($coupon);
    }

    public function show($id)
{
    $customers = Customer::all();
    $pendingTransaction = PendingTransaction::with('customer', 'pendingItems.item', 'pendingItems.size', 'pendingItems.coupon')->findOrFail($id);
    $categories = Categories::all();
    $coupons = Coupon::all();
    $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

    // Calculate discounts based on the pending items and associated coupons
    $discountDetails = [];
    $totalDiscount = 0;

    foreach ($pendingTransaction->pendingItems as $pending) {
        if ($pending->coupon) {

            $discountAmount = $pending->coupon->discount_amount;
            $totalDiscount += $discountAmount;
            $discountDetails[] = [
                'coupon_name' => $pending->coupon->name,
                'discount' => $discountAmount,
            ];
        }
    }

    return view('cashier.show', compact('pendingTransaction', 'customers', 'categories', 'dateTime', 'coupons', 'discountDetails', 'totalDiscount'));
}
    public function destroy($id)
{
    $pendingTransaction = PendingTransaction::findOrFail($id);
    $pendingTransaction->delete();

    $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

    return redirect()->route('cashier.index', compact('dateTime'))->with('success', 'Pending Transaction deleted successfully');
}
}
