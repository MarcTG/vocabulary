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

        DB::table('words')->insert([
            'singular' => 'Hund',
            'plural' => 'Hunde',
            'translation' => 'Perro',
            'word_type_id' => 2,
        ]);

        DB::table('words')->insert([
            'singular' => 'Sonne',
            'plural' => 'Sonnen',
            'translation' => 'Sol',
            'word_type_id' => 3,
        ]);

        DB::table('words')->insert([
            'singular' => 'Kind',
            'plural' => 'Kinder',
            'translation' => 'Ninos',
            'word_type_id' => 4,
        ]);
    }
}
