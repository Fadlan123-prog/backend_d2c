<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Sales;
use App\Models\Expends;

class TransactionsExport implements WithMultipleSheets
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
        $sheets = [];

        // Sheet 1: Total Pemasukan
        $sheets[] = new PemasukanSheet($this->startDate, $this->endDate);

        // Sheet 2: Total Pengeluaran
        $sheets[] = new PengeluaranSheet($this->startDate, $this->endDate);

        return $sheets;
    }
}

class PemasukanSheet implements FromCollection, WithHeadings
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
        // Mengambil data dari Sales dan SalesItem
        return Sales::with(['salesItems', 'salesItems.item', 'salesItems.size'])
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->get()
            ->map(function ($sale) {
                return $sale->salesItems->map(function ($item) use ($sale) {
                    return [
                        'date' => $sale->date,
                        'cashier_name' => $sale->cashier_name,
                        'item_name' => $item->item->name ?? 'N/A',
                        'size' => $item->size->name ?? 'N/A',
                        'quantity' => $item->quantity,
                        'price' => $item->harga_items,
                        'total_price' => $item->quantity * $item->harga_items,
                        'payment_method' => $sale->payment_method,
                    ];
                });
            })
            ->flatten(1);  // Menggabungkan semua item menjadi satu koleksi
    }

    public function headings(): array
    {
        return [
            'Date',
            'Cashier Name',
            'Item Name',
            'Size',
            'Quantity',
            'Price per Item',
            'Total Price',
            'Payment Method'
        ];
    }
}

class PengeluaranSheet implements FromCollection, WithHeadings
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
        return Expends::select('date', 'expend_name', 'expend_price')
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->get();
    }

    public function headings(): array
    {
        return ['Date', 'Expend Name', 'Expend Price'];
    }
}
