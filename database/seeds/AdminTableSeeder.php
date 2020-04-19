<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Admin 1",
            'role' => 'admin',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make("system3298"),
        ]);
        DB::table('users')->insert([
            'name' => "Admin 2",
            'role' => 'admin',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make("system3298"),
        ]);
        DB::table('users')->insert([
            'name' => "Admin 3",
            'role' => 'admin',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make("system3298"),
        ]);
    }
}
