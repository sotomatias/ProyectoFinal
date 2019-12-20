<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('place_id');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->string('name_place');
            $table->string('address_place');
            $table->string('schedule_place');
            $table->string('latitud');
            $table->string('longitud');
            $table->integer('phone_number');
            $table->string('website');
            $table->integer('category_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('place_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
