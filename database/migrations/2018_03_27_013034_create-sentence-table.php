<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('episodes_id')->unsigned();
            $table->string('english');
            $table->string('vietnamese');
            $table->timestamps();

            $table->foreign('episodes_id')
                  ->references('id')->on('episodes')
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
        Schema::drop('sentence');
    }
}
