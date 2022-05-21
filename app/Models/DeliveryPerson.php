<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPerson extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function storeOrUpdate($request)
    {
        $data = [
            'shift' => $request->shift,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'status' => 1
        ];
        // dd($request);
        if ($request->row_id) {
            DeliveryPerson::find($request->row_id)->update($data);
        } else {
            DeliveryPerson::create($data);
        }
        return true;
    }
}
