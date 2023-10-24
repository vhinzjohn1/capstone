<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('stages')->insert([
            ['name' => 'Introduction', 'unlock_condition' => 1],
            ['name' => 'Stage 1', 'unlock_condition' => 2],
            ['name' => 'Stage 2', 'unlock_condition' => 3],
            ['name' => 'Stage 3', 'unlock_condition' => 4],
            ['name' => 'Stage 4', 'unlock_condition' => 5],
            ['name' => 'Stage 5', 'unlock_condition' => 6],
            ['name' => 'Stage 6', 'unlock_condition' => 7],
            ['name' => 'Stage 7', 'unlock_condition' => 8],
            ['name' => 'Stage 8', 'unlock_condition' => 9],
            ['name' => 'Stage 9', 'unlock_condition' => 10],
            ['name' => 'Stage 10', 'unlock_condition' => 11],
            ['name' => 'Stage 11', 'unlock_condition' => 12],
        ]);
    }
}
