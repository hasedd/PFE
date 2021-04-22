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
            $table->enum('Type',['Question','Experience','Service']);
            $table->enum('space',['Public','Professors']);
            $table->string('Title');
            $table->text('Content');
            $table->string('Tags');
            $table->integer('Votes_up');
            $table->integer('Votes_down');
            $table->unsignedInteger('Views');
            $table->integer('Signals');
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
