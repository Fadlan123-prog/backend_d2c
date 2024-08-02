<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Categories;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\Expends;
use DB;

class CashierController extends Controller
{


    public function index()
    {
        $categories = Categories::all();
        $customers = Customer::all();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('cashier.view', compact('dateTime', 'categories', 'customers'));
    }

    public function addCustomer(Request $request){
        $validatedData = $request->validate([
            'plate_number' => 'required|string|max:255'
        ]);

        Customer::updateOrCreate(
            ['plate_number' => $validatedData['plate_number']],
            ['plate_number' => $validatedData['plate_number']]
        );

        return redirect()->back()->with('success', 'Customer saved successfully!');
    }

    public function getItemsByCategory($categoryId)
    {
        // Fetch items based on category ID
        $items = Item::where('category_id', $categoryId)->with('sizes')->get();

        // Return items as JSON response
        return response()->json($items);
    }

    public function close(Request $request)
    {
        // Total penjualan berdasarkan kategori
        $salesByCategory = SalesItem::select('items.category_id', DB::raw('SUM(sales_item.harga_items) as total_amount'))
            ->join('items', 'sales_item.item_id', '=', 'items.id')
            ->groupBy('items.category_id')
            ->get()
            ->map(function ($sale) {
                $category = Categories::find($sale->category_id);
                $sale->category_name = $category ? $category->categories_name : 'Unknown Category';
                return $sale;
            });

        // Total penjualan berdasarkan item
        $salesByItem = SalesItem::select('items.id', 'items.items_name', DB::raw('SUM(sales_item.harga_items) as total_amount'))
            ->join('items', 'sales_item.item_id', '=', 'items.id')
            ->groupBy('items.id', 'items.items_name')
            ->get();

        // Total penjualan
        $totalSales = Sales::sum('total_price');
        $totalCash = Sales::where('payment_method', 'cash')->sum('total_price');
        $totalTransfer = Sales::where('payment_method', 'transfer')->sum('total_price');
        $totalTokopedia = Sales::where('payment_method', 'tokopedia')->sum('total_price');

        $totalPaymentTypes = $totalCash + $totalTransfer + $totalTokopedia;

        // Total pengeluaran
        $expenses = Expends::all();
        $totalExpenses = $expenses->sum('amount');
        $expensesDetails = $expenses->map(function ($expense) {
            return ['item_name' => $expense->item_name, 'amount' => $expense->amount];
        });

        // Sisa penjualan tunai
        $remainingCash = $totalCash - $totalExpenses;
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        return view('page.closed.closed', compact(
            'salesByCategory',
            'salesByItem',
            'totalSales',
            'totalCash',
            'totalTransfer',
            'totalTokopedia',
            'totalPaymentTypes',
            'expensesDetails',
            'remainingCash',
            'dateTime'
        ));
    }
}
