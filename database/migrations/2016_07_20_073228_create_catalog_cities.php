<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalog_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('catalog_id')
                ->references('id')
                ->on('catalog')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_cities');
        Schema::dropForeign(['catalog_id', 'city_id']);
    }
}
