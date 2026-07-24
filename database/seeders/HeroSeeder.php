<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Hero::create([
            'name' => 'CPA Kimani',
            'profession' => 'Certified Public Accountant',
            'short_description' => 'Professional accountant specializing in finance and business solutions.',
            'photo' => 'uploads/profile.jpg',
            'resume' => 'uploads/resume.pdf',
          ]);
    }
}
