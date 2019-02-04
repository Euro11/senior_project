<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([        	
        	[
        		'role_name' => 'Student',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'role_name' => 'Teacher',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'role_name' => 'Admin',
        		'created_at' => date('Y-m-d H:i:s'),
        	]
        ]);
    }
}
