<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at');
            $table->integer('user_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->string('opinion');
            $table->integer('food');
            $table->integer('service');
            $table->integer('atmosphere');
            $table->integer('prices');

            $table->foreign('place_id')->references('place_id')->on('places')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinions');
    }
}
