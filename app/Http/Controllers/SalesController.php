<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        $sales->item_price = json_encode($request->prices);
        $sales->total_price = $request->subtotal;
        $sales->payment_method = $request->payment_type;
        $sales->save();

        return response()->json(['success' => 'Transaction stored successfully']);

        // Associate items with the transaction
        $transaction->items()->sync($validated['items']); // Adjust based on your relationship

        return redirect()->back()->with('success', 'Transaction stored successfully');
    }

    public function void(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'password' => 'required|string',
    ]);

    // Find the user by name
    $user = User::where('name', $request->name)->first();

    if ($user && $user->hasRole('admin') && Hash::check($request->password, $user->password)) {
        // Proceed with voiding the sale
        $saleId = $request->input('sale_id');
        $sale = Sales::find($saleId);

        if ($sale) {
            $sale->status = 'voided';
            $sale->save();

            return redirect()->route('sales.index')->with('success', 'Sale voided successfully.');
        } else {
            return redirect()->route('sales.index')->with('error', 'Sale not found.');
        }
    } else {
        return redirect()->route('sales.index')->with('error', 'Unauthorized access or incorrect credentials.');
    }
}
}
