<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rename4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->renameColumn('id', 'episodes_id');
            $table->renameColumn('img', 'episodes_img');
            $table->renameColumn('created_at', 'episodes_created_at');
            $table->renameColumn('updated_at', 'episodes_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->dropColumn('episodes_id');
            $table->dropColumn('episodes_img');
            $table->dropColumn('episodes_created_at');
            $table->dropColumn('episodes_updated_at');
        });
    }
}
