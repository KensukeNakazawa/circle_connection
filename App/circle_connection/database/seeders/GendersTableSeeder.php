<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            [
                'name' => '未選択'
            ],
            [
                'name' => '男'
            ],
            [
                'name' => '女'
            ],
            [
                'name' => 'その他'
            ]
        ]);
    }
}
