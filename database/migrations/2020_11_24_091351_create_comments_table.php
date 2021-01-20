<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body');
            $table->unsignedInteger('on_post')->nullable();
            $table->unsignedInteger('from_user')->nullable();
            $table->unsignedInteger('on_comment')->nullable();
            $table->foreign('on_post')
                ->references('id')->on('posts')
                ->onDelete('cascade');
            $table->foreign('from_user')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('on_comment')
                ->references('id')->on('comments')
                ->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}
