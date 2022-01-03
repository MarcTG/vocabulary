<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class WordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('word_types')->insert([
            'type' => 'andere'
        ]);
        DB::table('word_types')->insert([
            'type' => 'der'
        ]);
        DB::table('word_types')->insert([
            'type' => 'die'
        ]);
        DB::table('word_types')->insert([
            'type' => 'das'
        ]);
    }
}
