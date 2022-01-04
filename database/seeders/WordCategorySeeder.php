<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('word_categories')->insert([
            'name' => 'Familie',
            'translate' => 'Familia'
        ]);

        DB::table('word_categories')->insert([
            'name' => 'Tiere',
            'translate' => 'Aminales'
        ]);

        DB::table('word_categories')->insert([
            'name' => 'House',
            'translate' => 'Casa'
        ]);

        DB::table('word_categories')->insert([
            'name' => 'Auto',
            'translate' => 'Auto'
        ]);

        DB::table('word_categories')->insert([
            'name' => 'Sport',
            'translate' => 'Deporte'
        ]);
    }
}
