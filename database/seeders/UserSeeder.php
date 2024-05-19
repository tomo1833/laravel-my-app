<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // データの挿入
        DB::table('users')->insert([
            'name' => 'guest',
            'email' => 'guest@test.com',
            'password' => Hash::make('guest123'),
        ]);
    }
}
