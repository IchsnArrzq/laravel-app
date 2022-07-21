<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ProcessProduction;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 1000) as $product) {
            $product = Product::create(
                [
                    'customer_id' => collect(Customer::pluck('id'))->random(),
                    'part_name' => fake()->word(),
                    'part_number' => fake()->word() . '-' . fake()->lexify(),
                    'cycle_time' => fake()->biasedNumberBetween(),
                    'type' => 'PRODUCT-' . $product,
                    'unit' => fake()->biasedNumberBetween(),
                    'maker' =>  collect(['YAMAHA', 'HONDA', 'KAWASAKI', 'SUZUKI', 'DLL'])->random(1)->first() . '-' . $product,
                    'cavity' => 'CAVITY' . $product,
                    'machine_rate' => fake()->biasedNumberBetween(),
                    'welding_length' => fake()->biasedNumberBetween(),
                    'dies' => fake()->biasedNumberBetween(),
                    'dies_lifetime' => fake()->biasedNumberBetween(),
                ]
            );
            $product->process_productions()->sync(collect(ProcessProduction::pluck('id'))->random(3));
        }
    }
}
