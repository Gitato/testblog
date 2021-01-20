<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')->on('categories');
//            $table->foreign('tags_id')
//                ->references('tags_id')->on('tags_relationship')
//                ->onDelete('cascade');
        });
//        Schema::table('posts', function (Blueprint $table) {
//            $table->foreign('tags_id')
//                ->references('tags_id')->on('tags_relationship')
//                ->onDelete('cascade');
//        });
//        Schema::table('tags', function (Blueprint $table) {
//            $table->foreign('posts_id')
//                ->references('posts_id')->on('tags_relationship');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_key');
    }
}
