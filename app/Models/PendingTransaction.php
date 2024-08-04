<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingTransaction extends Model
{
    use HasFactory;

    protected $table = 'pending_transaction';

    protected $fillable = [
        'customer_id',
        'total_price',
        'payment_method',
        'date',
        'time',
        'cashier_name',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pendingItems()
    {
        return $this->hasMany(PendingItem::class);
    }

    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function items(){
        return $this->belongsTo(Item::class);
    }
}
