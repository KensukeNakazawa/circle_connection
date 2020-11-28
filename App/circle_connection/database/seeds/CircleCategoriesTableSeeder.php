<?php

use Illuminate\Database\Seeder;

class CircleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
