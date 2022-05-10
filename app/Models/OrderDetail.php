<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getProduct()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
