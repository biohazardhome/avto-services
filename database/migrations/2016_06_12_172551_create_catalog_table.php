<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('description');
            $table->longText('content');
            $table->string('phones');
            $table->string('email');
            $table->string('site');
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
        Schema::drop('catalog');
    }
}
