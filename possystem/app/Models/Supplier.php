<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name_supplier', 'phone_supplier', 'address_supplier'];

    public function purchase_orders()
    {
        return $this->hasMany('App\Models\PurchaseOrder', 'supplier_id');
    }
}
