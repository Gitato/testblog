<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsedTagsRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsed_tags_relationship', function (Blueprint $table) {
            $table->unsignedInteger('parsed_tag_id');
            $table->foreign('parsed_tag_id')
                ->references('id')
                ->on('parsed_tags')
                ->onDelete('cascade');
            $table->unsignedInteger('parsed_post_id');
            $table->foreign('parsed_post_id')
                ->references('id')
                ->on('parsed_posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parsed_tags_relationship');
    }
}
