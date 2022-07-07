<?php

namespace Database\Seeders;

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
                'name' => 'MACHINE 1',
                'number' => 'MCHN 1'
            ],
            [
                'name' => 'MACHINE 2',
                'number' => 'MCHN 2'
            ],
            [
                'name' => 'MACHINE 3',
                'number' => 'MCHN 3'
            ],
        ];
        Machine::insert($machines);
    }
}
