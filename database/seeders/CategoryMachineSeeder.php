<?php

namespace Database\Seeders;

use App\Models\CategoryMachine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryMachine::insert([
            [
                'name' => 'injection'
            ],
            [
                'name' => 'diesel'
            ],
            [
                'name' => 'steam'
            ]
        ]);
    }
}
