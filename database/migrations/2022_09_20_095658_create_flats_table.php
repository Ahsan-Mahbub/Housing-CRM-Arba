<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable();
            $table->text('flat_name')->nullable();
            $table->integer('status')->default(1);
            $table->integer('confirmattion')->default(0);
            $table->string('size')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('drawing')->nullable();
            $table->string('dining')->nullable();
            $table->string('balcony')->nullable();
            $table->string('floor')->nullable();
            $table->string('parking')->nullable();
            $table->string('basement')->nullable();
            $table->string('facing')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}
