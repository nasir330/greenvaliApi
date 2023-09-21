<?php

namespace Database\Seeders;

use App\Models\UserInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserInfo::create([
            'user_id'   => 1,
            'phone'     => '8555555555555',
            'address'   => 'Dhaka, Bangladesh',
        ]);
    }
}
