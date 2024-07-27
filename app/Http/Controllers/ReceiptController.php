<?php

namespace App\Http\Controllers;
use App\Models\Sales;
use App\Models\Customer;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function showReceipt($id)
{
    $sale = Sales::find($id);
    $customer = Customer::all();

    return view('page.receipt.index', compact('sale', 'customer'));
}
}
