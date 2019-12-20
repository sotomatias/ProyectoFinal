<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->bigIncrements('food_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('price',5,2);
            $table->integer('cat_id')->unsigned();
            $table->integer('place_id')->unsigned();

            $table->foreign('cat_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('place_id')->references('place_id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
