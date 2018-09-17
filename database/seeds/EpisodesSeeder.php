<?php

use Illuminate\Database\Seeder;

class EpisodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie')->insert([
            'movie_id' => '5',
            'episodes_img' => 'abccsdsfgff',
            'link' => 'abcdef',
            'episodes_created_at' => new DateTime(),
            'completed' => '2'
        ]);
    }
}
