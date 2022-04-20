<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
