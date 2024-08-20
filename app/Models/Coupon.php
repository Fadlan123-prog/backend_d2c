<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Item;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'item_id',
        'expired_date',
        'discount_amount',
        'discount_type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
