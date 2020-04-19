<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i< 40; $i++){
        DB::table('products')->insert([
            'name' => $faker->word,
            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'stock' => 10,
            'price' => $faker->numberBetween($min = 3000, $max = 9000), // 8567
            'image' => 'https://via.placeholder.com/150'
        ]);
    }
    }
}
