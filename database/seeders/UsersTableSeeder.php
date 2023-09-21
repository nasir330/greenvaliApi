<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id'       => 1,
            'first_name'    => 'Admin',
            'last_name'     => 'User',
            'email'         => 'admin@mail.com',
            'password'      => Hash::make('password')
        ]);
    }
}
