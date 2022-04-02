<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->integer('transaction_type')->nullable()->comment('P-1, PR-2, S-3, SR-4');
            $table->string('in_out');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('description')->nullable();
            $table->double('dc_manual')->default(0)->comment('taka');
            $table->double('dc_percentage')->default(0)->comment('taka');
            $table->double('dc_amount')->default(0)->comment('taka');
            $table->double('quantity');
            $table->double('price')->nullable();
            $table->double('price_after_discount')->nullable();
            $table->tinyInteger('status')->default(1)->comment('active = 1 inactive =2');
            $table->unsignedBigInteger('created_by')->default(0);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoice_transactions');
    }
}
