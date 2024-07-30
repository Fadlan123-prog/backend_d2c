<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales'; // Nama tabel

    protected $fillable = [
        'plate_number',
        'date',
        'time',
        'cashier_name',
        'item_id', // Ganti 'item_name' dengan 'item_id' jika ada relasi
        'item_price',
        'total_price',
        'status',
        'payment_method',
    ];

    // Relasi ke Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id'); // Menghubungkan dengan model Item
    }
}
