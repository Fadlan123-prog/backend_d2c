<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    use HasFactory;

    protected $table = 'sales_item';

    protected $fillable = ['sales_id', 'item_id', 'size_id', 'harga_items', 'quantity'];

    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function category()
    {
        return $this->item->belongsTo(Categories::class, 'category_id');
    }
}
