<?php

namespace App\Exports;

use App\Models\Sales;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SalesSummaryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;
    protected $categoryId;

    public function __construct($startDate, $endDate, $categoryId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->categoryId = $categoryId;
    }

    public function view(): View
    {
        $salesData = Sales::with(['salesItems.item.category', 'customer'])
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->when($this->categoryId, function ($query) {
                $query->whereHas('salesItems.item.category', function ($query) {
                    $query->where('id', $this->categoryId);
                });
            })
            ->get();

        return view('exports.sales', [
            'salesData' => $salesData
        ]);
    }
}
