<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function storeOrUpdate($request){
        $data = [
            'name' => $request->name,
            'local_name' => $request->local_name,
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'brand' => $request->brand,
            'unit' => $request->unit,
            'buy_price' => $request->buy_price ?? 0,
            'buy_price_code' => $request->buy_price_code,
            'sell_price' => $request->sell_price ?? 0,
            'sell_price_code' => $request->sell_price_code,
            'reorder_level' => $request->reorder_level ?? 0,
            'product_code' => $request->product_code,
            'serial' => $request->serial ?? 99,
            'item_group' => $request->item_group,
            'description' => $request->description,
        ];

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/product'), $imageName);
            $data['image'] = $imageName;
        }
        if($request->row_id){
           self::find($request->row_id)->update($data);
        }else{
            self::create($data);
        }
        return true;
    }

    public function getCategory(){
        return $this->belongsTo(ProductCategory::class, 'category');
    }

    public function getSubCategory(){
        return $this->belongsTo(ProductCategory::class, 'sub_category');
    }

    public function getBrand(){
        return $this->belongsTo(Brand::class, 'brand');
    }

    public function getUnit(){
        return $this->belongsTo(Unit::class, 'unit');
    }
}
