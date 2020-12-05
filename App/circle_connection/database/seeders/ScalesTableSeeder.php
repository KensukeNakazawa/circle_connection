<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScalesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
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
