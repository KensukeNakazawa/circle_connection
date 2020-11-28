<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
