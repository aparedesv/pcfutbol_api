<?php

namespace App\Libraries;

use Carbon\Carbon;
use Faker\Factory;
use App\Models\Equip;
use App\Models\Atribut;
use App\Models\Jugador;
use App\Models\JugadorAtribut;
use App\Models\Plantilla;
use App\Models\JugadorPosicio;

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
                with('plantilla.atributs')->
                with('plantilla.posicions')->
                find($id);
        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        $equip = Equip::create($payload);

        self::_novaPlantilla($equip);

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
        app('db')->transaction(function() use(&$equip) {

            $faker = Factory::create();

            for($i = 0; $i < env('NUM_JUGADORS_NOVA_PLANTILLA'); $i++)
            {
                $jugador = Jugador::create([

                    'nom' => $faker->firstNameMale(),
                    'cognoms' => $faker->lastName(),
                    'data_naixement' => self::_dataNaixement($faker)
                ]);

                Plantilla::create([
                    'id_jugador' => $jugador->id,
                    'id_equip' => $equip->id,
                    'ordre' => $i + 1
                ]);

                if ($i < 2)
                {
                    self::_posicionsJugador($jugador, env('POSICIO_PORTER'));
                }

                if ($i > 1 && $i < 8)
                {
                    self::_posicionsJugador($jugador, env('POSICIO_DEFENSA_PRIMER'), env('POSICIO_DEFENSA_ULTIM'));
                }

                if ($i > 7 && $i < 14)
                {
                    self::_posicionsJugador($jugador, env('POSICIO_MIG_PRIMER'), env('POSICIO_MIG_ULTIM'));
                }

                if ($i > 13 && $i < 20)
                {
                    self::_posicionsJugador($jugador, env('POSICIO_DAVANTER_PRIMER'), env('POSICIO_DAVANTER_ULTIM'));
                }

                self::_atributsJugador($jugador);
            }
        });

    }

    private function _dataNaixement($faker)
    {
        $data_naixement = $faker->dateTimeBetween(
            Carbon::now()->subYears(env('EDAD_MAXIMA_NOU_JUGADOR')),
            Carbon::now()->subYears(env('EDAD_MINIMA_NOU_JUGADOR'))
        );

        return Carbon::parse($data_naixement)->format('Y-m-d');
    }

    private function _posicionsJugador($jugador, $posicioInicial, $posicioFinal = NULL)
    {
        if($posicioFinal <> NULL)
        {
            $posicioPrincipalId = rand($posicioInicial, $posicioFinal);
            $posicions = [$posicioPrincipalId];

            JugadorPosicio::create([
                'id_jugador' => $jugador->id,
                'id_posicio' => $posicioPrincipalId
            ]);

            for($i=0; $i < rand(1,4); $i++)
            {
                $posicioId = rand($posicioInicial, $posicioFinal);
                if(in_array($posicioId, $posicions) == FALSE)
                {
                    JugadorPosicio::create([
                        'id_jugador' => $jugador->id,
                        'id_posicio' => $posicioId
                    ]);
                }
            }
        }
        else
        {
            JugadorPosicio::create([
                'id_jugador' => $jugador->id,
                'id_posicio' => $posicioInicial,
            ]);
        }
    }

    private function _atributsJugador($jugador)
    {
        $atributs = Atribut::all();

        foreach ($atributs as $atribut)
        {
            JugadorAtribut::create([
                'id_jugador' => $jugador->id,
                'id_atribut' => $atribut->id,
                'valor' => rand(35, 65)
            ]);
        }
    }
}
