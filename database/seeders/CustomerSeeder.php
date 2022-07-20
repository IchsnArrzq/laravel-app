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
                    'name' => "customer$value",
                    'email' => "customer$value@testing.com",
                    'password' => $password,
                ],
                'customer' => [
                    'alias' => "customer$value",
                    'pic' => collect(['manager', 'staff', 'direktur'])->random(1)->first(),
                    'primary' => 'primary',
                    'secondary' => 'secondary',
                    'number_fax' => rand(100, 20000),
                    'postcode' => rand(100,10000),
                    'address' => 'address',
                    'remark' => 'remark',
                ]
            ];
        }
        foreach (array_chunk($customers, 300) as $chunk) {
            foreach($chunk as $item){
                User::create($item['user'])->assignRole('customer')->customer()->create($item['customer']);
            }
        }
    }
}
