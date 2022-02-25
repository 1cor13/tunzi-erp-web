<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
    		[
    			'country_name' => 'Uganda',
                'short_code' => '256',
                'country_code' => 'UG',
    			'country_region' => 'East Africa'
    		],
    		[
    			'country_name' => 'Kenya',
                'short_code' => '254',
    			'country_code' => 'KE',
    			'country_region' => 'East Africa'
    		],
    		[
    			'country_name' => 'Tanzania',
                'short_code' => '253',
    			'country_code' => 'TZ',
    			'country_region' => 'East Africa'
    		],
    		[
    			'country_name' => 'Rwanda',
                'short_code' => null,
    			'country_code' => 'RW',
    			'country_region' => 'East Africa'
    		],
    		[
    			'country_name' => 'Burundi',
                'short_code' => null,
    			'country_code' => 'BR',
    			'country_region' => 'East Africa'
    		]
        ];

        foreach ($countries as $key => $value) {
        	Country::create($value);
        }
    }
}
