<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Categories;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Sales;
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
        $salesByCategory = Sales::select('items.category_id', DB::raw('SUM(total_price) as total_amount'))
            ->join('items', 'sales.item_id', '=', 'items.id')
            ->groupBy('items.category_id')
            ->get()
            ->map(function ($sale) {
                $sale->category_name = Categories::find($sale->category_id)->categories_name;
                return $sale;
            });

        // Total penjualan berdasarkan item
        $salesByItem = Sales::select('items.id', 'items.items_name', DB::raw('SUM(total_price) as total_amount'))
            ->join('items', 'sales.item_id', '=', 'items.id')
            ->groupBy('items.id', 'items.items_name')
            ->get();

        // Total penjualan
        $totalSales = Sales::sum('total_price');
        $totalCash = Sales::where('payment_method', 'cash')->sum('total_price');
        $totalTransfer = Sales::where('payment_method', 'transfer')->sum('total_price');
        $totalTokopedia = Sales::where('payment_method', 'tokopedia')->sum('total_price');

        $totalPaymentTypes = $totalCash + $totalTransfer + $totalTokopedia;

        // Total pengeluaran
        $expenses = Expense::all();
        $totalExpenses = $expenses->sum('amount');
        $expensesDetails = $expenses->map(function ($expense) {
            return ['item_name' => $expense->item_name, 'amount' => $expense->amount];
        });

        // Sisa penjualan tunai
        $remainingCash = $totalCash - $totalExpenses;

        return view('cashier.close', compact(
            'salesByCategory',
            'salesByItem',
            'totalSales',
            'totalCash',
            'totalTransfer',
            'totalTokopedia',
            'totalPaymentTypes',
            'expensesDetails',
            'remainingCash'
        ));
    }
}
