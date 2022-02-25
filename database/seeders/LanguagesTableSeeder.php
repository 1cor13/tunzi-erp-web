<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\Country;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'English',
        		'language_description' => 'The English language'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Luganda',
        		'language_description' => 'Olulimi Oluganda'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Runyankole',
        		'language_description' => '',
                'status' => 'not available'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Rutoro',
        		'language_description' => '',
                'status' => 'not available'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Lusoga',
        		'language_description' => '',
                'status' => 'not available'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Acholi',
        		'language_description' => '',
                'status' => 'not available'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Langi',
        		'language_description' => '',
                'status' => 'not available'
        	],
        	[
        		'country_id' => Country::all()->first()->id,
        		'language_name' => 'Kiswahili',
        		'language_description' => '',
                'status' => 'not available'
        	]
        ];

        foreach ($languages as $key => $value) {
        	Language::create($value);
        }
    }
}
