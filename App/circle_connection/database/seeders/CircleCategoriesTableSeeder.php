<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CircleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('circle_categories')->insert([
            [
                'name' => '未選択'
            ],
            [
                'name' => 'スポーツ'
            ],
            [
                'name' => '文化'
            ],
            [
                'name' => 'イベント'
            ],
            [
                'name' => 'その他'
            ],
        ]);
    }
}
