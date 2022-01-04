<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Familie',
            'translation' => 'Familia',
            'slug' => 'familie'
        ]);

        DB::table('categories')->insert([
            'name' => 'Tiere',
            'translation' => 'Aminales',
            'slug' => 'tiere'
        ]);

        DB::table('categories')->insert([
            'name' => 'House',
            'translation' => 'Casa',
            'slug' => 'house'
        ]);

        DB::table('categories')->insert([
            'name' => 'Auto',
            'translation' => 'Auto',
            'slug' => 'auto'
        ]);

        DB::table('categories')->insert([
            'name' => 'Sport',
            'translation' => 'Deporte',
            'slug' => 'sport'
        ]);
    }
}
