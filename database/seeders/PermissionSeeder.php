<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [];
        $results = scandir(app_path() . "/Models");
        $methods = [
            'index',
            'create',
            'store',
            'edit',
            'update',
            'delete'
        ];
        foreach ($results as $result) {
            foreach ($methods as $method) {
                if ($result === '.' or $result === '..') continue;
                $permissions[] = [
                    'name' => Str::slug(str_replace('.php', '', $result) . '-' . $method . '-' . 'access'),
                    'guard_name' => 'web'
                ];
            }
        }
        foreach (array_chunk($permissions, 300) as $chunk) {
            foreach ($chunk as $item) {
                Permission::create($item);
            }
        }
    }
}
