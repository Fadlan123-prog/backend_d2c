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
use App\Models\Coupon;
use DB, Log, Auth;

class CashierController extends Controller
{


    public function index()
    {
        $categories = Categories::all();
        $customers = Customer::all();
        $coupons = Coupon::all();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('cashier.view', compact('dateTime', 'categories', 'customers', 'coupons'));
    }

    public function addCustomer(Request $request){
        $validated = $request->validate([
            'plate_number' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $customer = new Customer();
        $customer->plate_number = $validated['plate_number'];
        $customer->nama = $validated['nama'];
        $customer->phone_number = $validated['phone_number'];
        $customer->save();

        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    public function getCustomer($id){
        $customer = Customer::findOrFail($id);

        if ($customer) {
            return response()->json([
                'name' => $customer->name,
                'plate_number' => $customer->plate_number,
                'phone_number' => $customer->phone_number,
            ]);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
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
        // Get the selected date or use today's date as default
        $date = $request->input('date', now()->format('Y-m-d'));

        // Parse the date to ensure it's valid
        try {
            $parsedDate = Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Handle invalid date
            return redirect()->back()->withErrors(['Invalid date provided']);
        }

        // Debugging information

        // Filter the sales by the selected date and include only those with a null status
        $salesByCategory = SalesItem::select('items.category_id', DB::raw('COUNT(sales_item.item_id) as items_sold'), DB::raw('SUM(sales_item.harga_items) as total_amount'))
            ->join('items', 'sales_item.item_id', '=', 'items.id')
            ->join('sales', 'sales_item.sales_id', '=', 'sales.id')
            ->whereDate('sales.date', $parsedDate)
            ->whereNull('sales.status') // Include only sales with null status
            ->groupBy('items.category_id')
            ->get()
            ->map(function ($sale) {
                $category = Categories::find($sale->category_id);
                $sale->category_name = $category ? $category->categories_name : 'Unknown Category';
                return $sale;
            });

        // Log the sales by category
        Log::info('Sales by Category: ' . $salesByCategory->toJson());

        // Filter the sales by the selected date and include only those with a null status
        $salesByItem = SalesItem::select('items.id', 'items.items_name', DB::raw('COUNT(sales_item.item_id) as items_sold'), DB::raw('IFNULL(sizes.size, "") as size_name'), DB::raw('SUM(sales_item.harga_items) as total_amount'))
            ->join('items', 'sales_item.item_id', '=', 'items.id')
            ->leftJoin('sizes', 'sales_item.size_id', '=', 'sizes.id')
            ->join('sales', 'sales_item.sales_id', '=', 'sales.id')
            ->whereDate('sales.date', $parsedDate)
            ->whereNull('sales.status') // Include only sales with null status
            ->groupBy('items.id', 'items.items_name', 'sizes.size')
            ->get();

        // Log the sales by item

        // Filter total sales and payment methods by the selected date and include only those with a null status
        $totalSales = Sales::whereDate('date', $parsedDate)
            ->whereNull('status') // Include only sales with null status
            ->sum('total_price');

        $totalCash = Sales::where('payment_method', 'cash')
            ->whereDate('date', $parsedDate)
            ->whereNull('status') // Include only sales with null status
            ->sum('total_price');

        $totalTransfer = Sales::where('payment_method', 'transfer')
            ->whereDate('date', $parsedDate)
            ->whereNull('status') // Include only sales with null status
            ->sum('total_price');

        $totalTokopedia = Sales::where('payment_method', 'tokopedia')
            ->whereDate('date', $parsedDate)
            ->whereNull('status') // Include only sales with null status
            ->sum('total_price');

        $totalPaymentTypes = $totalCash + $totalTransfer + $totalTokopedia;


        // Filter expenses by the selected date
        $expenses = Expends::whereDate('created_at', $parsedDate)->get();
        $totalExpenses = $expenses->sum('expend_price');
        $expensesDetails = $expenses->map(function ($expense) {
            return ['expend_name' => $expense->expend_name, 'expend_price' => $expense->expend_price];
        });

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        // Remaining cash after expenses
        $remainingCash = $totalCash - $totalExpenses;

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
            'totalExpenses',
            'dateTime',
            'date'
        ));
    }

    public function printReceipt($date)
    {
        // Parse the date to ensure it's valid
        try {
            $parsedDate = Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Handle invalid date
            return redirect()->back()->withErrors(['Invalid date provided']);
        }

        // Get the data for the receipt
        $salesItems = SalesItem::select(
            'items.category_id',
            'items.items_name',
            DB::raw('IFNULL(sizes.size, "N/A") as size_name'),
            DB::raw('COUNT(sales_item.item_id) as items_sold'),
            DB::raw('SUM(sales_item.harga_items) as total_amount')
        )
        ->join('items', 'sales_item.item_id', '=', 'items.id')
        ->leftJoin('sizes', 'sales_item.size_id', '=', 'sizes.id') // Use leftJoin to include items without sizes
        ->join('sales', 'sales_item.sales_id', '=', 'sales.id')
        ->whereDate('sales.date', $parsedDate)
        ->whereNull('sales.status')
        ->groupBy('items.category_id', 'items.id', 'items.items_name', 'sizes.size')
        ->get();

        // Organize the data by category
        $salesByCategory = [];
        foreach ($salesItems as $item) {
            $category = Categories::find($item->category_id);
            $categoryName = $category ? $category->categories_name : 'Unknown Category';
            $salesByCategory[$categoryName][] = $item;
        }

        $totalSales = Sales::whereDate('date', $parsedDate)
            ->whereNull('status')
            ->sum('total_price');

        $totalCash = Sales::where('payment_method', 'cash')
            ->whereDate('date', $parsedDate)
            ->whereNull('status')
            ->sum('total_price');

        $totalTransfer = Sales::where('payment_method', 'transfer')
            ->whereDate('date', $parsedDate)
            ->whereNull('status')
            ->sum('total_price');

        $totalTokopedia = Sales::where('payment_method', 'tokopedia')
            ->whereDate('date', $parsedDate)
            ->whereNull('status')
            ->sum('total_price');

        $totalPaymentTypes = $totalCash + $totalTransfer + $totalTokopedia;

        $expenses = Expends::whereDate('created_at', $parsedDate)->get();
        $totalExpenses = $expenses->sum('expend_price');
        $expensesDetails = $expenses->map(function ($expense) {
            return ['expend_name' => $expense->expend_name, 'expend_price' => $expense->expend_price];
        });

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        $remainingCash = $totalCash - $totalExpenses;
        $cashierName = Auth::user()->name;
        $dateClosed = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $timeClosed = Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s');

        return view('page.receipt.closed', compact(
            'salesByCategory',
            'totalSales',
            'totalCash',
            'totalTransfer',
            'totalTokopedia',
            'totalPaymentTypes',
            'expensesDetails',
            'remainingCash',
            'totalExpenses',
            'dateTime',
            'date',
            'cashierName',
            'dateClosed',
            'timeClosed'
        ));
    }
}
