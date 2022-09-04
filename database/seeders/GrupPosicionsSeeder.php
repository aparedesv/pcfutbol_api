<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupPosicionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grup_posicions')->insert([
            ['nom' => 'porter'],
            ['nom' => 'defensa'],
            ['nom' => 'mig defensiu'],
            ['nom' => 'mig'],
            ['nom' => 'mitja punta'],
            ['nom' => 'davanter'],
        ]);
    }
}
