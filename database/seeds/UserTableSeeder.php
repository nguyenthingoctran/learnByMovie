c<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        	[
          		[
        		'name'=>'Trina',
        		'email'=>'trina@gmail.com',
        		'password'=>bcrypt('1234'),
        		'level'=>1,
        		'img'=>'abc',
        		'created_at'=> new DateTime(),
        		],

           		[
        		'name'=>'Andrew',
        		'email'=>'andrew@gmail.com',
        		'password'=>bcrypt('1234'),
        		'level'=>1,
        		'img'=>'def',
        		'created_at'=> new DateTime(),
        		],
        	]);    
    }
}
