<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\PendingTransaction;

use Illuminate\Http\Request;

class PendingTransactionController extends Controller
{
    public function index(){
        $categories = Categories::all();
        $customers = Customer::all();
        $pending_transaction = PendingTransaction::all();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('page.pending_transaction.index', compact('categories', 'customers', 'dateTime', 'pending_transaction'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer',
            'subtotal' => 'required|numeric',
            'payment_type' => 'required|string',
            'items' => 'required|json',
            'prices' => 'required|json',
            'item_ids' => 'required|json',
        ]);

        try {
            // Decode the JSON data
            $items = json_decode($validated['items'], true);
            $prices = json_decode($validated['prices'], true);
            $itemIds = json_decode($validated['item_ids'], true);

            // Create a new pending transaction entry
            $pendingTransaction = new PendingTransaction();
            $pendingTransaction->customer_id = $validated['customer_id'];
            $pendingTransaction->date = now()->format('Y-m-d');
            $pendingTransaction->time = now()->format('H:i:s');
            $pendingTransaction->cashier_name = auth()->user()->name; // Assume cashier is the logged in user
            $pendingTransaction->total_price = $validated['subtotal'];
            $pendingTransaction->payment_method = $validated['payment_type'];
            $pendingTransaction->save();

            // Create pending_transaction_item entries
            foreach ($itemIds as $index => $itemId) {
                $pendingTransactionItem = new PendingTransactionItem();
                $pendingTransactionItem->pending_transaction_id = $pendingTransaction->id;
                $pendingTransactionItem->item_id = $itemId;
                $pendingTransactionItem->harga_items = $prices[$index];
                $pendingTransactionItem->save();
            }

            return response()->json([
                'success' => true,
                'receipt_html' => view('receipt', compact('pendingTransaction', 'items'))->render()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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

    public function destroy($id){
        $pending = PendingTransaction::find($id);
        if($pending){
            $pending->delete();
            return redirect()->route('pending.transaction.index')->with('success', 'Data Deleted successfully');
        }

        return redirect()->route('pending.transaction.index')->with('error', 'Data not found');
    }
}
