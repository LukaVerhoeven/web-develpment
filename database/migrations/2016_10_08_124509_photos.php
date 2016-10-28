<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Photos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('photos', function (Blueprint $table) {
         $table->increments('id');
         $table->string('contestimage');
         $table->timestamps();
       });

       Schema::table('photos', function($table) {
         $table->integer('user_id')->unsigned();
         $table->foreign('user_id')->references('id')->on('users');
         $table->integer('wedstrijd_id')->unsigned();
         $table->foreign('wedstrijd_id')->references('id')->on('wedstrijddates');
       });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

      Schema::table('photos', function($table)
       {
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users');
           $table->integer('wedstrijd_id')->unsigned();
           $table->foreign('wedstrijd_id')->references('id')->on('wedstrijddates');
       });


    }
}
