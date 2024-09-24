<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = ['plate_number', 'nama', 'phone_number'];

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
