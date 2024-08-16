<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::all();
        $columns = DB::select("SHOW COLUMNS FROM customers");
        dd($columns);
        return view('cashier.view', compact('customer'));
    }

    public function store(Request $request){

        $request->validate([
            'plate_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $customer = new Customer();
        $customer->plate_number = $request->plate_number;
        $customer->nama = $request->nama;
        $customer->phone_number = $request->phone_number;
        $customer->save();


        return redirect()->route('cashier.index')->with(response()->json(['id' => $customer->id]));
    }
}
