<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoriesTableSeeder::class);
         $this->call(AdminTableSeeder::class);
         $this->call(CommentSeeder::class);
         $this->call(ProductTableSeeder::class);
         $this->call(BuyerSeeder::class);
    }
}
