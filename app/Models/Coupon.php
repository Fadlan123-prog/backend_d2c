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

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function couponItems()
    {
        return $this->hasMany(CouponItems::class);
    }
}
