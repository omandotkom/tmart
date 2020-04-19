<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
            $faker = Faker\Factory::create();
    
        for($i = 0 ; $i< 150; $i++){
            DB::table('comments')->insert([
                'user_id' => $faker->numberBetween($min = 5, $max = 35),
                'comment' => $faker->realText($maxNbChars = 80, $indexSize = 2),
                'product_id' => $faker->numberBetween($min = 0, $max = 40),
                'created_at' => Carbon::now(),
            ]);
    }
}
}