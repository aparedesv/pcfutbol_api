<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemporadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temporades')->insert([
            [
                'nom' => '2022-2023',
                'inici' => '2022-08-01',
                'final' => '2023-07-31',
            ],
            [
                'nom' => '2023-2024',
                'inici' => '2023-08-01',
                'final' => '2024-07-31',
            ],
        ]);
    }
}
