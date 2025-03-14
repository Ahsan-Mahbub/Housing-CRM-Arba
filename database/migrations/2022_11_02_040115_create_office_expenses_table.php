<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('method_id')->nullable();
            $table->foreignId('account_id')->nullable();
            $table->text('reason')->nullable();
            $table->string('amount')->nullable();
            $table->string('date')->nullable();
            $table->text('trx_details')->nullable();
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
        Schema::dropIfExists('office_expenses');
    }
}
