<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id', false, true);
            $table->date('receive_date');
            $table->integer('quanity');
            $table->decimal('total_cost', 10,2);
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
        Schema::drop('stock_ins');
    }
}
