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
        'harga',
    ];
}
