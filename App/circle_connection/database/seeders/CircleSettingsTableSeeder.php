<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CircleSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\CircleSetting::class, 50)->create();
    }
}
