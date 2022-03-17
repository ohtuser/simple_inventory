<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('local_name')->nullable();
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('sub_category')->nullable();
            $table->string('product_code')->nullable();
            $table->unsignedBigInteger('brand');
            $table->unsignedBigInteger('unit');
            $table->double('reorder_level')->nullable();
            $table->string('buy_price_code')->nullable();
            $table->float('buy_price')->default(0);
            $table->string('sell_price_code')->nullable();
            $table->float('sell_price')->default(0);
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('item_group')->default(1)->comment('1=consumeable,2=service');
            $table->boolean('status')->default(1)->comment('1=show,2=hide');
            $table->boolean('serial')->default(1)->comment('sorting col');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
