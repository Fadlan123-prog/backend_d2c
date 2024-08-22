<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponItems extends Model
{
    use HasFactory;

    protected $table = 'coupons_items';

    protected $fillable = [
        'coupon_id',  // Make sure this is included
        'item_id',
        'size_id',
        'final_price',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
