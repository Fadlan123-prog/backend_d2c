<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Expends;

class ExpendsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expends = Expends::all();

        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('page.expends.index', compact('dateTime', 'expends'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dateTime = Carbon::now()->setTimezone('Asia/Jakarta');
        return view('page.expends.create', compact('dateTime'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $expends = $request->input('expends');
        $date = $request->input('date');
        $time = $request->input('time');

        $jakartaTime = Carbon::now('Asia/Jakarta');

        foreach ($expends as $expend) {
            Expends::create([
                'date' => $jakartaTime->toDateString(),
                'time' => $jakartaTime->toTimeString(),
                'expend_name' => $expend['expend_name'],
                'expend_price' => $expend['expend_price'],
            ]);
        }

        return redirect()->route('expends.index')->with('success', 'Expenditures saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(expends $expends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expends $expends)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, expends $expends)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(expends $expends)
    {
        //
    }
}
