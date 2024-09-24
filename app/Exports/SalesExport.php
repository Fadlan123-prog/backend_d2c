<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sales::whereBetween('date', [$this->startDate, $this->endDate])
                    ->with('salesItems')
                    ->get()
                    ->map(function($sale) {
                        return [
                            'Date' => $sale->date,
                            'Time' => $sale->time,
                            'Customer' => $sale->customer->name ?? $sale->customer->plate_number,
                            'Total Quantity' => $sale->salesItems->sum('quantity'),
                            'Total Price' => $sale->total_price,
                            'Status' => $sale->status,
                            'Payment Method' => $sale->payment_method,
                        ];
                    });
    }

    /**
     * Heading for the excel columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Date',
            'Time',
            'Customer',
            'Total Quantity',
            'Total Price',
            'Status',
            'Payment Method',
        ];
    }
}

