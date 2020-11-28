<?php

use Illuminate\Database\Seeder;

class ScalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scales')->insert([
            [
                'name' => '未選択'
            ],
            [
                'name' => '〜25人'
            ],
            [
                'name' => '25〜50人'
            ],
            [
                'name' => '50〜100人'
            ],
            [
                'name' => '100人〜'
            ]
        ]);
    }
}
