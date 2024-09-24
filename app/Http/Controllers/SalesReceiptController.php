<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class SalesReceiptController extends Controller
{
    public function index()
    {
        // Load the first page of sales with their related customer data
        $sales = Sales::with('customer')->paginate(10);

        return view('page.sales-receipt.index', compact('sales'));
    }

    // Search function for live search by plate number
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for customers based on plate_number
        $customers = Customer::where('plate_number', 'like', '%' . $query . '%')->pluck('id');

        // Get paginated sales records for the customers found
        $sales = Sales::with('customer')
            ->whereIn('customer_id', $customers)
            ->paginate(10); // Paginate by 10 items per page

        // Return the paginated response with links
        return response()->json([
            'data' => $sales->items(),
            'links' => $sales->appends(['query' => $query])->links('pagination::bootstrap-4')->render(),
        ]);
    }

    // Show the receipt modal content
    public function show($id)
    {
        // Find the sale by ID and load the customer and sales items
        $sale = Sales::with('salesItems.item', 'customer')->find($id);

        // If no sale is found, return a 404 response
        if (!$sale) {
            return response()->json(['error' => 'Sale not found'], 404);
        }

        // Format data for the response
        $data = [
            'date' => $sale->date,
            'time' => $sale->time,
            'cashier_name' => $sale->cashier_name,
            'subtotal' => $sale->salesItems->sum(function ($item) {
                return $item->quantity * $item->harga_items;
            }),
            'discount' => $sale->coupon ? $sale->coupon->amount : 0,
            'total' => $sale->total_price,
            'items' => $sale->salesItems->map(function ($item) {
                return [
                    'name' => $item->item->items_name,
                    'quantity' => $item->quantity,
                    'price' => $item->harga_items,
                ];
            }),
        ];

        return response()->json($data);
    }
}
