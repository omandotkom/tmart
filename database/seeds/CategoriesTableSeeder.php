<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 'minyak',
            'name' => "Minyak",
        ]);
        DB::table('categories')->insert([
            'id' => 'gula',
            'name' => "Gula",
        ]);
        DB::table('categories')->insert([
            'id' => 'beras',
            'name' => "Beras",
        ]);
        DB::table('categories')->insert([
            'id' => 'daging',
            'name' => "Daging",
        ]);
        DB::table('categories')->insert([
            'id' => 'telur',
            'name' => "Telur",
        ]);
        DB::table('categories')->insert([
            'id' => 'susu',
            'name' => "Susu",
        ]);
        DB::table('categories')->insert([
            'id' => 'jagung',
            'name' => "Jagung",
        ]);
        DB::table('categories')->insert([
            'id' => 'gas',
            'name' => "Minyak Tanah/Gas",
        ]);
        DB::table('categories')->insert([
            'id' => 'garam',
            'name' => "Garam",
        ]);
        DB::table('categories')->insert([
            'id' => 'minuman',
            'name' => "Minuman",
        ]);
        DB::table('categories')->insert([
            'id' => 'makanan',
            'name' => "Makanan",
        ]);
        DB::table('categories')->insert([
            'id' => 'bumbu',
            'name' => "Bumbu Dapur",
        ]);
        DB::table('categories')->insert([
            'id' => 'other',
            'name' => "Lainnya",
        ]);
    }
}
