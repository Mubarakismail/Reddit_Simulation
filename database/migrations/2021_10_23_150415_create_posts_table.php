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
            $table->string('post_title');
            $table->string('post_image')->nullable();
            $table->string('post_video')->nullable();
            $table->text('post_body')->nullable();
            $table->string('post_url')->nullable();
            $table->integer('post_privacy')->default(1);
            $table->integer('rating')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('community_id')->unsigned()->default(1);
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
