<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['s_order_id', 'product_id', 'qty'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function sales_order()
    {
        return $this->belongsTo('App\Models\SalesOrder', 's_order_id');
    }
}
