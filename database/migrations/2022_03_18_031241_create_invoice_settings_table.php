<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_name');
            $table->string('invoice_prefix')->nullable();
            $table->longText('custom_css')->nullable();
            $table->longText('invoice_header')->nullable();
            $table->longText('invoice_footer')->nullable();
            $table->integer('fraction_digit')->nullable();
            $table->string('posting_field_show')->comment("(comma separated) 1=local_name, 2=stock, 3=unit, 4=posting description, 5=product details, 6=buy_price, 7=buy_price_code, 8=sell_price, 9=sell_price_code, 10=discount(%) 11=Manual discount 12=product code, 13=last purchase history")->nullable();
            $table->string('posting_field_label')->comment("comma separated")->nullable();
            $table->string('invoice_print_field_show')->comment("(comma separated) 1=name,2=local name, 3=product code,4=unit,5=price,6=qty,7=>total 8=discount,9=>net total, 10=current_stock, 11=note, 12=buy_price, 13=buy_price_code, 14=sell_price, 15=sell_price_code, 16=last purchase history, 17=balance, 18=in words")->nullable();
            $table->string('invoice_print_field_show_label')->comment("comma separated")->nullable();
            $table->timestamps();
        });

        DB::table('invoice_settings')->insert([
            ['id'=>1, 'invoice_name'=>'Purchase', 'invoice_prefix'=>'P-'],
            ['id'=>2, 'invoice_name'=>'Purchase Return', 'invoice_prefix'=>'PR-'],
            ['id'=>3, 'invoice_name'=>'Sell', 'invoice_prefix'=>'S-'],
            ['id'=>4, 'invoice_name'=>'Sell Return', 'invoice_prefix'=>'SR-']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_settings');
    }
}
