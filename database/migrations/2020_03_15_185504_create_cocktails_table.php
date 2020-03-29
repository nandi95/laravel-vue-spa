<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocktailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cocktails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('signature')->nullable();
            $table->string('bartender')->nullable();
            $table->string('bar_or_company')->nullable();
            $table->string('location')->nullable();
            $table->enum('season', ['Summer', 'Fall', 'Autumn', 'Winter', 'Spring'])->nullable();
            $table->string('ingredients')->nullable();
            $table->string('garnish')->nullable();
            $table->string('glassware')->nullable();
            $table->text('preparation')->nullable();
            $table->text('notes')->nullable();
            $table->string('legal')->nullable();
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
        Schema::dropIfExists('cocktails');
    }
}
