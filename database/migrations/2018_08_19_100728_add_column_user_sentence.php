<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserSentence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_sentence', function (Blueprint $table) {
            $table->dropColumn('sentence_id');
            $table->dropColumn('times');
            $table->integer('episodes_id');
            $table->integer('numOrder');
            $table->renameColumn('check', 'practice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_sentence', function (Blueprint $table) {
            //
        });
    }
}
