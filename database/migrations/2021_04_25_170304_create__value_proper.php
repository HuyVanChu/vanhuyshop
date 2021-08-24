<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValueProper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuecolumn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('properties_id')->unsigned();
            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('prd_id')->unsigned();
            $table->foreign('prd_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('valuecolumn');
    }
}
