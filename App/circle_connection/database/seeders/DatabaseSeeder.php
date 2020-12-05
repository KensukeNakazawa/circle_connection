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
        $this->call([
            // master table initial data
            CircleCategoriesTableSeeder::class,
            GendersTableSeeder::class,
            ScalesTableSeeder::class,
            UserTypesTableSeeder::class,
            // test data create
            UsersTableSeeder::class,
            CircleSettingsTableSeeder::class,
            UserSettingsTableSeeder::class,
            EventsTableSeeder::class
        ]);
    }
}
