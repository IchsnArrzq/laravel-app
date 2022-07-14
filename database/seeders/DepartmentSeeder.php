<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::insert([
            [
                'name' => 'Sales & Marketing'
            ],
            [
                'name' => 'HRD (Human Resources Department)'
            ],
            [
                'name' => 'Purchasing'
            ],
            [
                'name' => 'Production'
            ],
            [
                'name' => 'QA (Quality Assurance)'
            ],
            [
                'name' => 'Accounting'
            ],
            [
                'name' => 'Warehouse'
            ],
            [
                'name' => 'IT (Information & Technology)'
            ],
            [
                'name' => 'PPIC (Product Planning Inventory Control)'
            ],
            [
                'name' => 'GA (General Affairs)'
            ]
        ]);
    }
}
