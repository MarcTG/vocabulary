<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_words')->insert([
            'word_category_id' => '1',
            'word_id' => '1'
        ]);

        DB::table('category_words')->insert([
            'word_category_id' => '1',
            'word_id' => '2'
        ]);
    }
}
