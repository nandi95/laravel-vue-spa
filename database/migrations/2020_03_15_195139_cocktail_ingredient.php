<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CocktailIngredient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cocktail_ingredient', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('cocktail_id');
          $table->unsignedBigInteger('ingredient_id');
          $table->enum('unit', ['oz', 'ml', 'float', 'dash', 'springs', 'wedge', 'pinch', 'splash', 'tsp', 'leaves', 'whole'])->nullable();

          $table->foreign('cocktail_id')->references('id')->on('cocktails');
          $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cocktail_ingredient');
    }
}
