<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expends extends Model
{
    use HasFactory;

    protected $table = 'expends';

    protected $fillable = [
        'date',
        'time',
        'expend_name',
        'expend_price',
    ];
}
