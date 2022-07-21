<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\PlanningMachine;
use App\Models\Product;
use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanningMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 100) as $planning) {
            PlanningMachine::create([
                'product_id' => collect(Product::pluck('id'))->random(1)->first(),
                'machine_id' => collect(Machine::pluck('id'))->random(1)->first(),
                'shift_id' => collect(Shift::pluck('id'))->random(1)->first(),
                'datetimein' => fake()->date('Y-m-d H:i:s'),
                'datetimeout' => fake()->date('Y-m-d H:i:s'),
                'total' => fake()->randomDigit(),
                'qty_planning' => fake()->randomDigit()
            ]);
        }
    }
}
