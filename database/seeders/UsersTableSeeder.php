<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Ishizaki Takayuki',
        //     'email' => 'plactice@example.com',
        //     'password' => Hash::make('pw123'),  //Hash暗号化処理
        // ]);
        DB::table('users')->insert([
            [
                'username' => 'Ishizaki Takayuki',
                'email' => 'plactice@example.com',
                'password' => Hash::make('pw123'),
            ],
        ]);
    }
}
