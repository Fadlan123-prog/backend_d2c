<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Exports\SalesExport;
use App\Exports\SalesSummaryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Categories;
use Carbon\Carbon;
use App\Models\Expends;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data dari database dengan join ke tabel sales_item
        // $chartData = Sales::join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
        //                   ->selectRaw('DATE(sales.date) as date, SUM(sales_item.quantity) as total_quantity')
        //                   ->groupBy('date')
        //                   ->get();

        // Mengirim data ke view
        return view('page.summary.index');
    }

    public function fetchData(Request $request)
    {
        $startDate = $request->input('start_date') ?? Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ?? Carbon::now()->endOfMonth();

        // Logika untuk mengambil data sesuai rentang tanggal (untuk chart)
        $chartSalesData = Sales::join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereBetween('sales.date', [$startDate, $endDate])
            ->selectRaw('DATE(sales.date) as date, SUM(sales_item.quantity) as total_quantity')
            ->groupBy('date')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item['date'] => (int) $item['total_quantity']];  // Pastikan data dikirim dalam format yang benar
            });

        // Data Harian (hanya untuk hari ini)
        $todaySalesData = Sales::join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereDate('sales.date', Carbon::today())
            ->selectRaw('SUM(sales_item.quantity) as total_quantity')
            ->first();

        // Data Bulanan (untuk bulan ini)
        $thisMonthSalesData = Sales::join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereBetween('sales.date', [$startDate, $endDate])
            ->selectRaw('SUM(sales_item.quantity) as total_quantity')
            ->first();



        // Data Tahunan (untuk tahun ini)
        $thisYearSalesData = Sales::join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
            ->whereYear('sales.date', Carbon::now()->year)
            ->selectRaw('SUM(sales_item.quantity) as total_quantity')
            ->first();

        $thisMonthOmsetData = Sales::join('sales_item', 'sales.id', '=', 'sales_item.sales_id')
        ->whereBetween('sales.date', [$startDate, $endDate])
        ->selectRaw('SUM(sales.total_price) as total_omset')
        ->first();

        // Expend data for the requested date range
        $thisMonthExpendData = Expends::whereBetween('expends.date', [$startDate, $endDate])
            ->selectRaw('SUM(expend_price) as total_expends')
            ->first();

        return response()->json([
            'chartSalesData' => $chartSalesData->all(),
            'dailySales' => $todaySalesData->total_quantity ?? 0,  // Menangani jika datanya kosong
            'monthlySales' => $thisMonthSalesData->total_quantity ?? 0 ,
            'yearlySales' => $thisYearSalesData->total_quantity ?? 0,
            'monthlyOmset' => $thisMonthOmsetData->total_omset ?? 0,
            'monthlyExpend' => $thisMonthExpendData->total_expends ?? 0,
        ]);
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new SalesExport($startDate, $endDate), 'sales_data.xlsx');
    }

    public function salesSummary(Request $request){
        // Ambil input dari request atau gunakan nilai default
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));
        $categoryId = $request->input('category_id', null);

        // Query untuk mendapatkan semua kategori
        $categories = Categories::all(); // Asumsikan ada model Category

        // Query sales data with pagination
        $salesData = Sales::with(['salesItems.item.category', 'customer'])
            ->whereBetween('date', [$startDate, $endDate])
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('salesItems.item.category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            })
            ->paginate(10);

        // Kirim data ke view
        return view('page.sales-summary.index', compact('salesData', 'startDate', 'endDate', 'categoryId', 'categories'));
    }

    public function getSalesByDate(Request $request)
    {
        // Pisahkan nilai date_range menjadi start_date dan end_date
        $dateRange = $request->input('date_range');
        if ($dateRange) {
            list($startDate, $endDate) = explode(' - ', $dateRange);
        } else {
            // Gunakan default start dan end date jika tidak ada input
            $startDate = now()->startOfMonth()->format('Y-m-d');
            $endDate = now()->endOfMonth()->format('Y-m-d');
        }

        // Ambil category_id jika ada
        $categoryId = $request->input('category_id', null);

        // Query sales data with pagination
        $salesData = Sales::with(['salesItems.item.category', 'customer'])
            ->whereBetween('date', [$startDate, $endDate])
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('salesItems.item.category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            })
            ->paginate(10);

        // Ambil kategori
        $categories = Categories::all();

        // Kirim data ke view
        return view('page.sales-summary.index', compact('salesData', 'startDate', 'endDate', 'categoryId', 'categories'));
    }


    public function exportSalesToExcel(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $categoryId = $request->input('category_id', null);

    // Format tanggal sesuai dengan format yang diinginkan
    $formattedStartDate = Carbon::parse($startDate)->translatedFormat('d-F-Y'); // Contoh: 20-Februari-2024
    $formattedEndDate = Carbon::parse($endDate)->translatedFormat('d-F-Y'); // Contoh: 25-Februari-2024

    // Gabungkan untuk nama file
    $fileName = "sales_data_{$formattedStartDate}_to_{$formattedEndDate}.xlsx";

    // Menggunakan SalesExport untuk mengekspor data
    return Excel::download(new SalesSummaryExport($startDate, $endDate, $categoryId), $fileName);
}
}
