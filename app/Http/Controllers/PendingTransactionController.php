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

    public function store(Request $request){
        $sales = new PendingTransaction();
        $sales->plate_number = $request->plate_number;
        $sales->date = Carbon::now()->format('Y-m-d');
        $sales->time = Carbon::now()->format('H:i:s');
        $sales->cashier_name = auth()->user()->name; // Asumsikan user sudah login
        $sales->item_name = json_encode($request->items);
        $sales->total_price = $request->subtotal;
        $sales->payment_method = $request->payment_type;
        $sales->save();

        // Associate items with the transaction
        // $transaction->items()->sync($validated['items']); // Adjust based on your relationship

        return response()->json([
            'status' => 'success',
            'message' => 'Pending berhasil disimpan!',
            'redirect_url' => route('pending.transaction.index')
        ]);
    }

    public function show($id)
    {
        $transaction = PendingTransaction::findOrFail($id);

        return response()->json([
            'plate_number' => $transaction->plate_number,
            'item_name' => $transaction->item_name,
            'total_price' => $transaction->total_price,
            'payment_method' => $transaction->payment_method,

            // Add more fields as needed
        ]);
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
