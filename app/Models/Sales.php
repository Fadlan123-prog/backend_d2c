<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales'; // Nama tabel

    protected $fillable = [
        'customer_id',
        'date',
        'time',
        'cashier_name',
        'item_price',
        'total_price',
        'status',
        'payment_method',
    ];

    // Relasi ke Item
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesItems()
    {
        return $this->hasMany(SalesItem::class);
    }

    public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function items(){
        return $this->belongsTo(Item::class);
    }
}
