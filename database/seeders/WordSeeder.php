<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('words')->insert([
            'singular' => 'Mutter',
            'plural' => 'Mütter',
            'translation' => 'Madre',
            'word_type_id' => 3,
        ]);

        DB::table('words')->insert([
            'singular' => 'Vater',
            'plural' => 'Väter',
            'translation' => 'Padre',
            'word_type_id' => 2,
        ]);
    }
}
