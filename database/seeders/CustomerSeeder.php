<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [];
        $password = Hash::make('password');
        foreach (range(1, 1000) as $key => $value) {
            $customers[] = [
                'user' => [
                    'name' => fake()->name(),
                    'email' => fake()->unique()->email(),
                    'password' => $password,
                ],
                'customer' => [
                    'alias' => fake()->firstName(),
                    'pic' => fake()->jobTitle(),
                    'primary' => fake()->phoneNumber(),
                    'secondary' => fake()->e164PhoneNumber(),
                    'number_fax' => fake()->randomDigit(),
                    'postcode' => fake()->postcode(),
                    'address' => fake()->address(),
                    'remark' => fake()->sentence(15),
                ]
            ];
        }
        foreach (array_chunk($customers, 300) as $chunk) {
            foreach ($chunk as $item) {
                User::create($item['user'])->assignRole('customer')->customer()->create($item['customer']);
            }
        }
    }
}
