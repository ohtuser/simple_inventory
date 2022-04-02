<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
                $table->integer('transaction_type')->nullable()->comment('P-1, PR-2, S-3, SR-4');
                $table->timestamp('date')->nullable();
                $table->unsignedBigInteger('party_id')->nullable();
                $table->string('invoice_no')->nullable();
                $table->unsignedBigInteger('ref_invoice')->nullable();
                $table->string('ref_invoice_model')->nullable();
                $table->string('manual_ref_invoice')->nullable();
                $table->string('bill_no')->nullable();
                $table->date('bill_no_date')->nullable();
                $table->double('grand_total')->default(0);
                $table->double('discount')->default(0);
                $table->double('net_total')->default(0);
                $table->double('payable')->default(0);
                $table->double('pay')->default(0);
                $table->double('due')->default(0);
                $table->string('attachment')->nullable();
                $table->string('note')->nullable();
                $table->tinyInteger('status')->default(1)->comment('1=active, 2=inactive');
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
        Schema::dropIfExists('invoices');
    }
}
