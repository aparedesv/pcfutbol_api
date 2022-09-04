<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipusCompeticioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipus_competicio')->insert([
            [
                'nom' => 'lliga',
                'lliga' => TRUE,
                'copa' => FALSE,
                'anada_tornada' => TRUE,
                'numero_equips' => 18
            ],
            [
                'nom' => 'copa',
                'lliga' => FALSE,
                'copa' => TRUE,
                'anada_tornada' => TRUE,
                'numero_equips' => 32
            ],
            [
                'nom' => 'amistós',
                'lliga' => FALSE,
                'copa' => TRUE,
                'anada_tornada' => FALSE,
                'numero_equips' => 2
            ],
        ]);
    }
}
