<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Renamecolumnname3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movie', function (Blueprint $table) {
            $table->renameColumn('created_at', 'movie_created_at');
            $table->renameColumn('updated_at', 'movie_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movie', function (Blueprint $table) {
            $table->renameColumn('movie_created_at');
            $table->renameColumn('movie_updated_at');
        });
    }
}
