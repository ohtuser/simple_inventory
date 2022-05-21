<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function orderedBy()
    {
        return $this->belongsTo(User::class, 'party_id');
    }

    public function deliveredBy()
    {
        return $this->belongsTo(DeliveryPerson::class, 'delivered_by');
    }
}
