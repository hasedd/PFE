<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category');
            $table->enum('Type',['Question','Experience','Service']);
            $table->enum('space',['Public','Professors']);
            $table->string('Title');
            $table->text('Content');
            $table->string('Tags');
            $table->integer('Votes_up')->default(0);
            $table->integer('Votes_down')->default(0);
            $table->unsignedInteger('Views')->default(0);
            $table->integer('Signals')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
