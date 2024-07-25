<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use Carbon\Carbon;

class SalesController extends Controller
{

    public function index(){
        $sales = Sales::all();
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        return view('page.sales-list.index', compact('sales', 'dateTime'));
    }

    public function store(Request $request){
        // Validate the request

        // Create a new transaction record
        $sales = new Sales();
        $sales->plate_number = $request->plate_number;
        $sales->date = Carbon::now()->format('Y-m-d');
        $sales->time = Carbon::now()->format('H:i:s');
        $sales->cashier_name = auth()->user()->name; // Asumsikan user sudah login
        $sales->item_name = json_encode($request->items);
        $sales->total_price = $request->subtotal;
        $sales->payment_method = $request->payment_type;
        $sales->save();

        return response()->json(['success' => 'Transaction stored successfully']);

        // Associate items with the transaction
        $transaction->items()->sync($validated['items']); // Adjust based on your relationship

        return redirect()->back()->with('success', 'Transaction stored successfully');
    }

}
