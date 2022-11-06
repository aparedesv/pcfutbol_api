<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GrupPosicionsSeeder::class,
            PosicionsSeeder::class,
            AtributsSeeder::class,
            TemporadesSeeder::class,
            TipusCompeticioSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
