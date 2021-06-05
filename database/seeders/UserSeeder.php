<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
       		'role_id' => '1',
 			'name' => 'Md.Admin',
 			'user_name' => 'admin',
 			'email' => 'admin@blog.com',
 			'password' => bcrypt('rootadmin'),
        ]);

       DB::table('users')->insert([
       		'role_id' => '2',
 			'name' => 'Md.Author',
 			'user_name' => 'author',
 			'email' => 'author@blog.com',
 			'password' => bcrypt('rootauthor'),
        ]);
    }
}
