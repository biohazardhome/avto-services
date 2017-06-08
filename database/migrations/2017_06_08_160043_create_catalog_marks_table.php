<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_marks', function (Blueprint $t) {
            $t->increments('id');

            $t->integer('catalog_id')->unsigned();
            $t->integer('mark_id')->unsigned();

            $t->foreign('catalog_id')
                ->references('id')
                ->on('catalog')
                ->onDelete('cascade');

            $t->foreign('mark_id')
                ->references('id')
                ->on('marks')
                ->onDelete('cascade');

            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_marks');
    }
}
