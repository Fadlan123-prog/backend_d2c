<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Item;
use Illuminate\Support\Str;

class Coupon extends Model
{
    use HasFactory;

    protected $keyType = 'string'; // UUIDs are strings
    public $incrementing = false; // UUIDs are not incrementing

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // Generate UUID if not provided
            }
        });
    }

    protected $fillable = [
        'id',
        'name',
        'description',
        'category_id',
        'discount_amount',
        'discount_percentage',
        'expired_date',
    ];

    public function calculateDiscount($itemPrice)
    {
        // Calculate the discount based on the discount type (amount or percentage)
        if ($this->discount_percentage) {
            return $itemPrice * ($this->discount_percentage / 100);
        } elseif ($this->discount_amount) {
            return min($this->discount_amount, $itemPrice);
        }
        return 0;
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'coupons_items')->withPivot('size_id', 'final_price');
    }

    public function couponItems()
    {
        return $this->hasMany(CouponItems::class);
    }
}
