<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategoriesTableSeeder::class,
            CurrenciesTableSeeder::class,
            GendersTableSeeder::class,
            CountriesTableSeeder::class,
            DistrictsTableSeeder::class,
            LanguagesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
