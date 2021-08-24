<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('title');
            $table->integer('price')->default(0);
            $table->string('product_code')->unique();
            $table->integer('state')->default(0);
            $table->text('describer')->nullable();
            $table->text('info')->nullable();
            $table->string('image');
            $table->string('image2');
            $table->tinyInteger('featured');
            
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('trademark_id')->unsigned();
            $table->foreign('trademark_id')->references('id')->on('trademarks')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
