<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Wedstrijddates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('wedstrijddates', function (Blueprint $table) {
          $table->increments('id');
          $table->string('price');
          $table->date('startdate');
          $table->date('enddate');
          $table->string('won');
          $table->integer('lastended');
          $table->integer('isdeleted');
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
        Schema::drop('wedstrijddates');
    }
}
