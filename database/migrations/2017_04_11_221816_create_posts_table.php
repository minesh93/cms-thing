<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claws_post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('New Page');
            $table->string('type')->default('page');
            $table->string('slug')->unique();
            $table->string('template')->nullable();
            $table->string('status')->nullable();
            $table->boolean('visible')->default(true);
            $table->longText('content')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('claws_post');
    }
}