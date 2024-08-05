<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\PendingTransaction;
use App\Models\PendingItem;
use Log;

use Illuminate\Http\Request;

class PendingTransactionController extends Controller
{
    public function index(){
        $categories = Categories::all();
        $customers = Customer::all();
        $pendingTransaction = PendingTransaction::with('customer', 'pendingItems.item', 'pendingItems.size')->get();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('page.pending_transaction.index', compact('categories', 'customers', 'dateTime', 'pendingTransaction'));
    }

    public function store(Request $request)
    {
            // Decode the JSON data
            $items = json_decode($request->items_id, true);

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
            $pendingTransaction->total_price = $request->subtotal;
            $pendingTransaction->payment_method = $request->payment_type;
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
                    ]);
                }
            }
            // Create pending_transaction_item entries

            return response()->json(['success' => true, 'pending_transaction_id' => $pendingTransaction->id]);
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

    public function show($id){
        $customers = Customer::all();
        $pendingTransaction = PendingTransaction::with('customer', 'pendingItems.item', 'pendingItems.size')->findOrFail($id);
        $categories = Categories::all();
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        return view('cashier.show', compact('pendingTransaction', 'customers', 'categories', 'dateTime'));
    }

    public function destroy($id)
{
    $pendingTransaction = PendingTransaction::findOrFail($id);
    $pendingTransaction->delete();

    return response()->json(['message' => 'Pending transaction deleted successfully']);
}
}
