<?php

use Illuminate\Database\Seeder;

class KindTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kind')->insert(
        	[
        		'name'=>'Đại Dương',
        		'created_at'=> new DateTime,

        	]);     }
}
