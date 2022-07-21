<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\PlanningMachine;
use App\Models\Production;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 100) as $key => $minute) {
            Production::create([
                'machine_id' => collect(Machine::pluck('id'))->random(),
                'line_stop_a' => rand(1, 100),
                'line_stop_b' => rand(1, 100),
                'line_stop_c' => rand(1, 100),
                'line_stop_other' => rand(1, 100),
                'qty_actual' => rand(1, 1000),
                'datetime' => now()->subMinute((int)$key . '0'),
                'status' => 1,
                'created_at' => now()->subMinute((int)$key . '0'),
                'updated_at' => now()->subMinute((int)$key . '0'),
            ]);
        }
    }
}
