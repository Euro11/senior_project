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
        	'name' => 'Super Admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('password'),
            'img_profile' => 'user.png',
        	'role' => 3,
        	'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
