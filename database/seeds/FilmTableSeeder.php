<?php

use Illuminate\Database\Seeder;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie')->insert([
            'movie_poster' => 'abccd',
            'kindId' => 3,
            'movie_created_at' => new DateTime(),
            'movie_name_1' => 'fiding dory',
        ]);
    }
}
