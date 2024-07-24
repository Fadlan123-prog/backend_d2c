<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Categories;
use App\Models\Item;
use App\Models\Customer;

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
        $items = Item::where('category_id', $categoryId)->get();

        // Return items as JSON response
        return response()->json($items);
    }
}
