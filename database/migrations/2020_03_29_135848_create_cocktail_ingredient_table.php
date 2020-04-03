<?php

use App\Enums\UnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocktailIngredientTable extends Migration
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
            $table->float("amount");
            $table->tinyInteger('unit')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
