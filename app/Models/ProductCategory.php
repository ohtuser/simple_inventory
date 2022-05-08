<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    function getCategory()
    {
        return $this->belongsTo(self::class, 'parent');
    }

    function getSubCategory()
    {
        return $this->hasMany(self::class, 'parent');
    }

    public static function storeOrUpdate($request)
    {
        $data = [
            'name' => $request->name,
            'parent' => $request->parent,
        ];
        // dd($request);
        if ($request->row_id) {
            self::find($request->row_id)->update($data);
        } else {
            self::create($data);
        }
        return true;
    }

    function getProductsSubCatWise()
    {
        return $this->hasMany(Products::class, 'sub_category');
    }
}
