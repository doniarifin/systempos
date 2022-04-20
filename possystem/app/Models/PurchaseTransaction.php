<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['p_order_id', 'product_id', 'qty'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function purchase_order()
    {
        return $this->belongsTo('App\Models\PurchaseOrder', 'p_order_id');
    }
}
