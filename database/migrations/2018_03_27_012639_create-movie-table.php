<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('poster');
            $table->integer('kind_id')->unsigned();
            $table->timestamps();

            $table->foreign('kind_id')
                  ->references('id')->on('kind')
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
        Schema::drop('movie');
    }
}
