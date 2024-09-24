<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Categories;
use Carbon\Carbon;

class SalesSummaryController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'date_range' => 'nullable|in:today,yesterday,last_7_days,last_30_days,this_month,last_month,custom',
            'start_date' => 'required_if:date_range,custom|date',
            'end_date' => 'required_if:date_range,custom|date|after_or_equal:start_date',
        ]);

        // Ambil filter kategori jika ada
        $categoryId = $request->input('category_id');

        // Date Range Picker
        $dateRange = $request->input('date_range');
        $dates = $this->getDateRange($dateRange);

        // Filter berdasarkan kategori jika ada
        $salesQuery = Sales::with('salesItems');

        if ($categoryId) {
            $salesQuery->whereHas('salesItems.item', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
        }

        // Summary Data menggunakan filtered salesQuery
        $dailySales = (clone $salesQuery)
            ->selectRaw('SUM(sales_item.quantity) as total_quantity')
            ->join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereDate('date', Carbon::today())
            ->value('total_quantity');

        $monthlySales = (clone $salesQuery)
            ->selectRaw('SUM(sales_item.quantity) as total_quantity')
            ->join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->value('total_quantity');

        $yearlySales = (clone $salesQuery)
            ->selectRaw('SUM(sales_item.quantity) as total_quantity')
            ->join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereYear('date', Carbon::now()->year)
            ->value('total_quantity');

        // Data untuk Chart
        $chartData = $this->getChartData($salesQuery, $dates['start_date'], $dates['end_date']);

        // Dapatkan semua kategori untuk filter
        $categories = Categories::all();

        return view('page.summary.index', compact('dailySales', 'monthlySales', 'yearlySales', 'chartData', 'dates', 'categories'));
    }

    public function updateChart(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $salesQuery = Sales::with('salesItems');

        $chartData = $this->getChartData($salesQuery, $startDate, $endDate);

        return response()->json(['chartData' => $chartData]);
    }

    private function getDateRange($dateRange)
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        switch ($dateRange) {
            case 'today':
                return [
                    'start_date' => $today,
                    'end_date' => $today,
                ];
            case 'yesterday':
                return [
                    'start_date' => $yesterday,
                    'end_date' => $yesterday,
                ];
            case 'last_7_days':
                return [
                    'start_date' => Carbon::now()->subDays(6),
                    'end_date' => $today,
                ];
            case 'last_30_days':
                return [
                    'start_date' => Carbon::now()->subDays(29),
                    'end_date' => $today,
                ];
            case 'last_month':
                return [
                    'start_date' => $startOfLastMonth,
                    'end_date' => $endOfLastMonth,
                ];
            case 'custom':
                $startDate = Carbon::parse(request()->input('start_date'));
                $endDate = Carbon::parse(request()->input('end_date'));
                return [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ];
            default:
                return [
                    'start_date' => $startOfWeek,
                    'end_date' => $today,
                ];
        }
    }

    private function getChartData($salesQuery, $startDate, $endDate)
    {
        return $salesQuery->selectRaw('DATE(date) as date, SUM(sales_item.quantity) as total_quantity')
            ->join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }
}
