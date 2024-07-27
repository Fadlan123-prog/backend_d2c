<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingTransaction extends Model
{
    use HasFactory;

    protected $table = 'pending_transaction';

    protected $fillable = [
        'plate_number',
        'item_name',
        'item_price',
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
}
