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

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('page.pending_transaction.index', compact('categories', 'customers', 'dateTime'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'plate_number' => 'required|string',
            'subtotal' => 'required|numeric|min:0',
            'items' => 'required|array', // Array of item IDs
            'items.*' => 'exists:items,id' // Ensure each item ID exists in the items table
        ]);

        // Create a new transaction record
        $transaction = new PendingTransaction();
        $transaction->plate_number = $validated['plate_number'];
        $transaction->subtotal = $validated['subtotal'];
        $transaction->status = 'pending'; // Status for "Pending"
        $transaction->save();

        // Associate items with the transaction
        $transaction->items()->sync($validated['items']); // Adjust based on your relationship

        return response()->json(['message' => 'Transaction is pending.'], 200);
    }
}
