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
        $sale->status = 'void';
        $sale->save();

        return redirect()->back()->with('success', 'Sale voided successfully.');
    }

}
