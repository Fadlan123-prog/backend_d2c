<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingItem extends Model
{
    use HasFactory;

    protected $table = 'pending_items';

    protected $fillable = ['pending_transaction_id', 'item_id', 'size_id', 'harga_items'];


    public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function pending()
    {
        return $this->belongsTo(PendingTransaction::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
