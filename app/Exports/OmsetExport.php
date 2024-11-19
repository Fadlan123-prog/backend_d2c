<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OmsetExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Sales::whereBetween('date', [$this->startDate, $this->endDate])
                    ->select('date', 'total_price')
                    ->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Omset'];
    }

}
