<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'kensuke.n',
            'email' => 'infokensuke.n@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('test1234'),
            'remember_token' => Str::random(10),
            // 'api_token' => Str::random(60),
            'user_type_id' => 3,
            'picture_url' => 'noimage.jpg'
        ]);
    }
}
