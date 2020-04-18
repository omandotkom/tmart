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
            'name' => "Admin",
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("system3298"),
        ]);
    }
}
