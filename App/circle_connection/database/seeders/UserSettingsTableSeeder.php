<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\UserSetting::class, 50)->create();
    }
}
