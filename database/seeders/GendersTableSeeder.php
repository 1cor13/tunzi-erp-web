<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
        	[
        		'gender_name' => 'Male',
        		'gender_description' => 'The masculine gender',
        		'status' => 'active'
        	],
        	[
        		'gender_name' => 'Female',
        		'gender_description' => 'The feminine gender',
        		'status' => 'active'
        	],
        	[
        		'gender_name' => 'Both',
        		'gender_description' => 'Both genders',
        		'status' => 'active'
        	],
        	[
        		'gender_name' => 'Other',
        		'gender_description' => 'Not disclosing gender',
        		'status' => 'active'
        	]
        ];

        foreach ($genders as $key => $value) {
        	Gender::create($value);
        }
    }
}
