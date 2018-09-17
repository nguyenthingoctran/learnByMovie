<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnWrong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_episodes', function (Blueprint $table) {
            $table->renameColumn('wrong', 'numOrderWrong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_episodes', function (Blueprint $table) {
            $table->dropColumn('wrong', 'numOrderWrong');
        });
    }
}
