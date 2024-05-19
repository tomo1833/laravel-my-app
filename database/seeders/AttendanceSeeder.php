<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // データの挿入
        DB::table('attendances')->insert([
            'user_id' => 1,
            'date' => Carbon::today()->toDateString(),
            'check_in' => Carbon::now(),
            'check_out' => Carbon::now()->addHours(8),
            'rest_period' => 1,
            'memo' => '初日の記録',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
