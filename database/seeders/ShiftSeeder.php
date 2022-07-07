<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            [
                'name' => 'SHIFT 1'
            ],
            [
                'name' => 'SHIFT 2'
            ],
            [
                'name' => 'SHIFT 3'
            ],
        ];
        Shift::insert($shifts);
    }
}
