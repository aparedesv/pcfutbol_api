<?php

namespace App\Libraries;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Equip;
use App\Models\Jugador;
use App\Models\Plantilla;

class EquipLibrary
{
    public function index()
    {
        return Equip::all();
    }

    public function show($id)
    {
        try {

            return Equip::
                with('club')->
                with('club.ciutat')->
                with('plantilla')->
                find($id);
        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        $equip = Equip::create($payload);

        $this->_novaPlantilla($equip);

        return $equip;
    }

    public function update($id, $payload)
    {
        try {
            $equip = Equip::find($id);

            $equip->nom = $payload['nom'];
            $equip->id_club = $payload['id_club'];

            $equip->save();

            return $equip;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function destroy($id)
    {
        try {

            $equip = Equip::find($id);
            $equip->destroy($id);

            return $equip;

        } catch (\Throwable $th) {

            return NULL;
        }

    }

    private function _novaPlantilla($equip)
    {
        $faker = Factory::create();

        for($i = 0; $i < env('NUM_JUGADORS_NOVA_PLANTILLA'); $i++)
        {
            $jugador = Jugador::create([

                'nom' => $faker->firstNameMale(),
                'cognoms' => $faker->lastName(),
                'data_naixement' => $this->_dataNaixement($faker)
            ]);

            Plantilla::create([
                'id_jugador' => $jugador->id,
                'id_equip' => $equip->id,
            ]);

        }

    }

    private function _dataNaixement($faker)
    {
        $data_naixement = $faker->dateTimeBetween(
            Carbon::now()->subYears(env('EDAD_MAXIMA_NOU_JUGADOR')),
            Carbon::now()->subYears(env('EDAD_MINIMA_NOU_JUGADOR'))
        );

        return Carbon::parse($data_naixement)->format('Y-m-d');
    }
}
