<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOutProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_out_id', false, true);
            $table->integer('product_id', false, true); 
            $table->date('expiry_date');
            $table->date('batch_number');

            $table->integer('quanity');
            
            $table->integer('free')->default(0);
            $table->decimal('flat_rate')->nullable();
            
            $table->decimal('total_cost', 10,2);
            $table->timestamps();

            $table->foreign('stock_out_id')->references('id')->on('stock_outs');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock_out_products');
    }
}
