<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosicionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posicions')->insert([
            ['nom' => 'PTR', 'descripcio' => 'porter', 'id_grup' => 1],
            ['nom' => 'DLD', 'descripcio' => 'lateral dret', 'id_grup' => 2],
            ['nom' => 'DLE', 'descripcio' => 'lateral esquerra', 'id_grup' => 2],
            ['nom' => 'DCD', 'descripcio' => 'central dret', 'id_grup' => 2],
            ['nom' => 'DCE', 'descripcio' => 'central esquerra', 'id_grup' => 2],
            ['nom' => 'DLL', 'descripcio' => 'lliure', 'id_grup' => 2],
            ['nom' => 'MDC', 'descripcio' => 'mig defensiu', 'id_grup' => 3],
            ['nom' => 'MDD', 'descripcio' => 'mig defensiu dret', 'id_grup' => 3],
            ['nom' => 'MDE', 'descripcio' => 'mig defensiu esquerra', 'id_grup' => 3],
            ['nom' => 'MCD', 'descripcio' => 'mig dret', 'id_grup' => 4],
            ['nom' => 'MCE', 'descripcio' => 'mig esquerra', 'id_grup' => 4],
            ['nom' => 'MCC', 'descripcio' => 'mig centre', 'id_grup' => 4],
            ['nom' => 'MOC', 'descripcio' => 'mig ofensiu', 'id_grup' => 5],
            ['nom' => 'MOD', 'descripcio' => 'mig ofensiu dret', 'id_grup' => 5],
            ['nom' => 'MOE', 'descripcio' => 'mig ofensiu esquerra', 'id_grup' => 5],
            ['nom' => 'DVC', 'descripcio' => 'davanter centre', 'id_grup' => 6],
            ['nom' => 'DV2', 'descripcio' => 'segon davanter', 'id_grup' => 6],
            ['nom' => 'DVD', 'descripcio' => 'extrem dret', 'id_grup' => 6],
            ['nom' => 'DVE', 'descripcio' => 'extrem esquerra', 'id_grup' => 6],
        ]);
    }
}
