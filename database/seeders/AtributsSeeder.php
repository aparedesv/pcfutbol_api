<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtributsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atributs')->insert([
            ['nom' => 'forma_fisica'],
            ['nom' => 'qualitat'],
            ['nom' => 'agressivitat'],
            ['nom' => 'moral'],
            ['nom' => 'regat'],
            ['nom' => 'velocitat'],
            ['nom' => 'xut'],
            ['nom' => 'falta'],
            ['nom' => 'penal'],
            ['nom' => 'cap'],
        ]);
    }
}
