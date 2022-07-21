<?php

namespace Database\Seeders;

use App\Models\CategoryMachine;
use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 100) as $machine) {
            Machine::create(
                [
                    'category_machine_id' => collect(CategoryMachine::pluck('id'))->random(),
                    'name' => fake()->sentence(5) . ' ' . fake()->word(),
                    'number' => fake()->randomDigit(),
                    'code' =>  fake()->randomDigit() . '-' . fake()->sentence(5) . ' ' . fake()->word(),
                    'brand' => collect(['HONDA', 'KAWASAKI', 'YAMAHA', 'SUZUKI'])->random(1)->first(),
                    'purchase_date' => fake()->date(),
                    'manufacture_date' => fake()->date(),
                    'stroke' => random_int(1, 100),
                    'production_area' => fake()->sentence(10),
                ],
            );
        }
    }
}
