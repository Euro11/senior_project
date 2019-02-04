<?php

use Illuminate\Database\Seeder;

class WeekTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('week')->insert([        	
        	[
        		'day_name' => 'อาทิตย์',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'day_name' => 'จันทร์',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'day_name' => 'อังคาร',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'day_name' => 'พุธ',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'day_name' => 'พฤหัสบดี',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'day_name' => 'ศุกร์',
        		'created_at' => date('Y-m-d H:i:s'),
        	],        	
        	[
        		'day_name' => 'เสาร์',
        		'created_at' => date('Y-m-d H:i:s'),
        	],
        ]);
    }
}
