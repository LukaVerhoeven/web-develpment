<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Votes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('votes', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
        });

        Schema::table('votes', function($table) {
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
          $table->integer('photo_id')->unsigned();
          $table->foreign('photo_id')->references('id')->on('photos');
        });
      }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      
    }
}
