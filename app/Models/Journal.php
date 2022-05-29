<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getInvoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function getParty()
    {
        return $this->belongsTo(User::class, 'party_id');
    }
}
