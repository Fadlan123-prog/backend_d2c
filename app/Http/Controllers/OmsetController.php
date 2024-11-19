<?php

namespace App\Http\Controllers;

use App\Exports\MonthlyReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OmsetController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new MonthlyReportExport($startDate, $endDate), 'MonthlyReport.xlsx');
    }
}
