<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::all();

        return view('cashier.view', compact('customer'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'plate_number' => 'required|unique:customers,plate_number|string|max:255'
        ]);

        $customer = Customer::updateOrCreate(
            ['plate_number' => $validatedData['plate_number']],
            ['plate_number' => $validatedData['plate_number']]
        );

        return response()->json(['id' => $customer->id]);
    }
}
