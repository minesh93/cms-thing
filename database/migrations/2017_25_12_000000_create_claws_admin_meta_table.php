<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClawsAdminMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claws_admin_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->nullable();
            $table->string('key');
            $table->string('type')->default('string');
            $table->longText('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claws_admin_meta');
    }
}
