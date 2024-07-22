<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';

    protected $fillable = [
        'items_name',
        'harga_item',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'item_size')->withPivot('price');
    }
}
