<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnSentence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sentence', function (Blueprint $table) {
            $table->renameColumn('id', 'sentence_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sentence', function (Blueprint $table) {
            $table->dropColumn('id','sentence_id');
        });
    }
}
