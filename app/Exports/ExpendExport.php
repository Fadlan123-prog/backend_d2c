<?php

namespace App\Exports;

use App\Models\Expends;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpendExport implements FromCollection
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
        return Expends::whereBetween('date', [$this->startDate, $this->endDate])
                      ->select('date', 'expend_name', 'expend_price')
                      ->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Pengeluaran', 'Harga'];
    }
}
