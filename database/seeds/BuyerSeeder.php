<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i< 100; $i++){
        DB::table('users')->insert([
            'name' => $faker->name,
            'role' => "buyer",
            'password' => Hash::make('system3298'),
            'email' => $faker->email, // 8567
        ]);
    }
}
}
