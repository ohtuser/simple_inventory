<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function storeOrUpdate($request){
        $data = [
            'name' => $request->name,
            'status' => 1
        ];
        // dd($request);
        if($request->row_id){
           self::find($request->row_id)->update($data);
        }else{
            self::create($data);
        }
        return true;
    }
}
