<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([        	
        	'name' => 'Admin Super',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('password'),
        	'role' => 3,
        	'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
