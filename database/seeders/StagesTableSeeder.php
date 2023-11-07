<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('stages')->insert([
            ['name' => 'Introduction', 'unlock_condition' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 1', 'unlock_condition' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 2', 'unlock_condition' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 3', 'unlock_condition' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 4', 'unlock_condition' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 5', 'unlock_condition' => 6, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 6', 'unlock_condition' => 7, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 7', 'unlock_condition' => 8, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 8', 'unlock_condition' => 9, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 9', 'unlock_condition' => 10, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 10', 'unlock_condition' => 11, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Stage 11', 'unlock_condition' => 12, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

