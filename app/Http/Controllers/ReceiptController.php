<?php

namespace App\Http\Controllers;
use App\Models\Sales;
use App\Models\Customer;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function showReceipt($id)
    {
        // Fetch the sales record along with related salesItems and customer
        $sales = Sales::with(['salesItems.item', 'salesItems.size', 'customer'])->findOrFail($id);

        // Get the current date and time in the Asia/Jakarta timezone
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        // Pass the data to the view
        return view('page.receipt.index', compact('sales', 'dateTime'));
    }
}
