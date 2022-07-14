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
        $machines = [
            [
                'category_machine_id' => collect(CategoryMachine::pluck('id'))->random(),
                'name' => 'MACHINE 1',
                'number' => '01',
                'code' => 'MACHINE-01',
                'brand' => 'honda',
                'purchase_date' => now()->format('Y-m-d'),
                'manufacture_date' => now()->format('Y-m-d'),
                'stroke' => random_int(1, 100),
                'production_area' => 'production area',
            ],
            [
                'category_machine_id' => collect(CategoryMachine::pluck('id'))->random(),
                'name' => 'MACHINE 2',
                'number' => '02',
                'code' => 'MACHINE-02',
                'brand' => 'honda',
                'purchase_date' => now()->format('Y-m-d'),
                'manufacture_date' => now()->format('Y-m-d'),
                'stroke' => random_int(1, 100),
                'production_area' => 'production area',
            ],
            [
                'category_machine_id' => collect(CategoryMachine::pluck('id'))->random(),
                'name' => 'MACHINE 3',
                'number' => '03',
                'code' => 'MACHINE-03',
                'brand' => 'honda',
                'purchase_date' => now()->format('Y-m-d'),
                'manufacture_date' => now()->format('Y-m-d'),
                'stroke' => random_int(1, 100),
                'production_area' => 'production area',
            ],
        ];
        Machine::insert($machines);
    }
}
