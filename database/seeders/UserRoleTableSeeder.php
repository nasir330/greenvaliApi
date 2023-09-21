<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create([
            'name'  => 'Admin',
            'slug'  => Str::slug('Admin')
        ]);

        UserRole::create([
            'name'  => 'Employee',
            'slug'  => Str::slug('Employee')
        ]);

        UserRole::create([
            'name'  => 'Customer',
            'slug'  => Str::slug('Customer')
        ]);
    }
}
