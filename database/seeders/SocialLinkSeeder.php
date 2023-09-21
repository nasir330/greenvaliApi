<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialLink::create([
            'name'  => 'facebook'
        ]);

        SocialLink::create([
            'name'  => 'linkedin'
        ]);

        SocialLink::create([
            'name'  => 'twitter'
        ]);

        SocialLink::create([
            'name'  => 'vimeo'
        ]);
    }
}
