<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebars', function (Blueprint $table) {
            $table->id();
            $table->string('module_name');
            $table->string('group_name')->nullable();
            $table->string('name');
            $table->string('route');
            $table->string('icon');
            $table->integer('sort')->nullable();
            $table->boolean('permission_admin')->default(0)->comment('1=can access');
            $table->boolean('permission_stuff')->default(0)->comment('1=can access');
            $table->boolean('permission_customer')->default(0)->comment('1=can access');
            $table->boolean('status')->comment('1=show,0=hide')->default(0);
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
        Schema::dropIfExists('sidebars');
    }
}
