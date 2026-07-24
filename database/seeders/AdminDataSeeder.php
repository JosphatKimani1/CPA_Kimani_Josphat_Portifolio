<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'username' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('1111')
        // ]);
        DB::table('users')->updateOrInsert(
    [
        'email' => 'admin@gmail.com'
    ],
    [
        'username' => 'Admin',
        'password' => Hash::make('1111')
    ]
);
    }
}
