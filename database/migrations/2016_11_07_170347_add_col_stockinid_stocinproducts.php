<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColStockinidStocinproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_in_products', function (Blueprint $table) {
            $table->integer('stock_in_id', false, true)->after('id');
            $table->foreign('stock_in_id')->references('id')->on('stock_ins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_in_products', function (Blueprint $table) {
            //
        });
    }
}
