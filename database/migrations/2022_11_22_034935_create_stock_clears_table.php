<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockClearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_clears', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_item_id')->nullable();
            $table->foreignId('stock_id')->nullable();
            $table->foreignId('item_id')->nullable();
            $table->string('clear_qty')->nullable();
            $table->string('clear_qty_price')->nullable();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
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
        Schema::dropIfExists('stock_clears');
    }
}
