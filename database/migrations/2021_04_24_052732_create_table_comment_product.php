<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCommentProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_product', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('comment');
            $table->integer('use_id')->unsigned()->nullable();
            $table->foreign('use_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('use_admin_id')->unsigned()->nullable();
            $table->foreign('use_admin_id')->references('id')->on('admin_user')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('state')->nullable();
            $table->string('parent')->nullable();
            $table->string('name_user_comment')->nullable();
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
        Schema::dropIfExists('comment_product');
    }
}
