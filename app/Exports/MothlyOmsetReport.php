<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MonthlyReportExport implements WithMultipleSheets
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        return [
            'Omset Harian' => new OmsetExport($this->startDate, $this->endDate),
            'Pengeluaran' => new ExpendExport($this->startDate, $this->endDate),
        ];
    }
}
