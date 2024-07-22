<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
    ];

    // Relationship with Item
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_size')->withPivot('price');
    }
}
