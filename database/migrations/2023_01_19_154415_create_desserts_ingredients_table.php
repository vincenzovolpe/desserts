<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDessertsIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desserts_ingredients', function (Blueprint $table) {
            $table->id();

            $table->unsignedBiginteger('desserts_id')->unsigned();;
            $table->unsignedBiginteger('ingredients_id')->unsigned();

            $table->float('quantita');
            $table->string('unita_misura');

            $table->foreign('desserts_id')->references('id')
                 ->on('desserts')->onDelete('cascade');
            $table->foreign('ingredients_id')->references('id')
                ->on('ingredients')->onDelete('cascade');

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
        Schema::dropIfExists('desserts_ingredients');
    }
}
