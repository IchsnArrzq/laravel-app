<?php

namespace Database\Seeders;

use App\Models\ProcessProduction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcessProduction::insert([
            [
                'name' => 'food and beverage'
            ],
            [
                'name' => 'oil and gas'
            ],
            [
                'name' => 'pharmaceuticals'
            ],
            [
                'name' => 'personal care and cosmetics'
            ],
            [
                'name' => 'plastics'
            ],
            [
                'name' => 'metals'
            ],
        ]);
    }
}
