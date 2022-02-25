<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
        	[ 
        		'name' => 'Uganda Shillings',
        		'code' => 'UGX' ,
                'rate' => '1.6'
        	],
        	[ 
        		'name' => 'US Dollar',
        		'code' => 'USD',
                'rate' => '1.6' 
        	],
        	[ 
        		'name' => 'Kenya Shillings',
        		'code' => 'KSH',
                'rate' => '1.6'  
        	],
        	[ 
        		'name' => 'Tanzania Shillings',
        		'code' => 'TSH',
                'rate' => '1.6'  
        	],
        	[ 
        		'name' => 'Euro',
        		'code' => 'EUR',
                'rate' => '1.6'  
        	]
        ];

        foreach ($currencies as $key => $value) {
        	Currency::create($value);
        }
    }
}
