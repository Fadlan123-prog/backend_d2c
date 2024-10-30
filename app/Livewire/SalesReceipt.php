<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Sales;

class SalesReceipt extends Component
{
    public $query;
    public $customers = [];
    public $sale;
    public $items = [];
    public $subtotal;
    public $discount;
    public $total;

    public function updatedQuery()
    {
        // Mencari pelanggan berdasarkan plate_number
        $this->customers = Customer::with('sales.salesItems.item')
            ->where('plate_number', 'like', '%' . $this->query . '%')
            ->get();
    }

    public function showReceipt($saleId)
    {
        // Ambil data sale dan sales item
        $this->sale = Sales::with('salesItems.item', 'customer')->find($saleId);

        // Hitung subtotal, discount, dan total
        $this->items = $this->sale->salesItems;
        $this->subtotal = $this->item->sum(function ($item) {
            return $item->quantity * $item->harga_items;
        });
        $this->discount = $this->sale->coupon ? $this->sale->coupon->amount : 0;
        $this->total = $this->sale->total_price;

        // Buka modal receipt
        $this->dispatchBrowserEvent('show-receipt-modal');
    }

    public function render()
    {
        return view('livewire.sales-receipt');
    }
}

