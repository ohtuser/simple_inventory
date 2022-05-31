<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function get_party()
    {
        return $this->belongsTo(User::class, 'party_id');
    }
}
