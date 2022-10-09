<?php

namespace App\Libraries;

use Exception;
use App\Models\Partit;
use App\Models\Jugador;
use App\Models\JugadorAtribut;
use App\Models\PartitGol;
use App\Models\PartitActa;
use App\Models\JugadorLesio;
use App\Models\PartitJugador;
use App\Models\JugadorTargeta;

class PartitLibrary
{
    public function index()
    {
        return Partit::orderBy('id_competicio')->orderBy('jornada')->get();
    }

    public function show($id)
    {
        try {

            return Partit::
                with('competicio')->
                with('acta')->
                with('camp')->
                with('jugadors')->
                with('equipLocal')->
                with('equipVisitant')->
                find($id);

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function update($id, $payload)
    {
        try {

            $partit = Partit::find($id);

            $partit->nom = $payload['nom'];
            $partit->id_camp = $payload['id_camp'];
            $partit->inici = $payload['inici'];

            $partit->save();

            return $partit;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function jugar($id, $id_equip, $visitant = NULL)
    {
        try {

            self::_checkTargetes($id_equip);
            self::_checkLesions($id_equip);

        } catch (\Throwable $th) {

            return NULL;
        }

        $equip = 'equip_local_ok';
        if($visitant)
        {
            $equip = 'equip_visitant_ok';
        }

        $alineacio = Jugador::
            with('posicions')->
            join('plantilles', 'jugadors.id', '=', 'plantilles.id_jugador')->
            where('plantilles.id_equip', $id_equip)->
            orderBy('plantilles.ordre', 'ASC')->
            limit(env('NUM_JUGADORS_PARTIT'))
            ->get();

        $acta = PartitActa::where('id_partit', $id)->first();

        app('db')->transaction(function() use(&$id, &$alineacio, &$equip, &$acta) {

            if($acta->partit_finalitzat == FALSE)
            {
                foreach ($alineacio as $jugador)
                {
                    PartitJugador::create([
                        'id_partit' => $id,
                        'id_jugador' => $jugador->id,
                        'id_posicio' => $jugador->posicions[0]->id,
                        'minut_inici_posicio' => 0
                    ]);
                }
            }

            $acta->$equip = TRUE;
            $acta->save();
        });

        return self::_checkPartitOk($acta->id);
    }

    private function _checkTargetes($id_equip)
    {
        $alineacio = JugadorTargeta::
            join('plantilles', 'jugador_targetes.id_jugador', '=', 'plantilles.id_jugador')->
            where('plantilles.id_equip', $id_equip)->
            orderBy('plantilles.ordre', 'ASC')->
            limit(env('NUM_JUGADORS_PARTIT'))->
            get();

        foreach ($alineacio as $jugador)
        {
            if($jugador->vermella || $jugador->grogues >= env('NUM_TARGETES_GROGUES_SANCIO'))
            {
                throw new Exception();
            }
        }
    }

    private function _checkLesions($id_equip)
    {
        $alineacio = JugadorLesio::
            join('plantilles', 'jugador_lesions.id_jugador', '=', 'plantilles.id_jugador')->
            where('plantilles.id_equip', $id_equip)->
            orderBy('plantilles.ordre', 'ASC')->
            limit(env('NUM_JUGADORS_PARTIT'))->
            get();

        foreach ($alineacio as $jugador)
        {
            if($jugador->lesio)
            {
                throw new Exception();
            }
        }
    }

    private function _checkPartitOk($actaId)
    {
        $acta = PartitActa::find($actaId);
        $response = $acta;

        if($acta->equip_local_ok == TRUE && $acta->equip_visitant_ok == TRUE && $acta->partit_finalitzat == FALSE)
        {
            $response = self::_getResultat($acta);
        }

       return $response;
    }

    private function _getResultat($acta)
    {
        $variables = [
            'mitja_total' => [],
            'moral' => [],
            'qualitat' => [],
            'forma_fisica' => [],
            'local' => NULL,
            'visitant' => NULL,
        ];

        $partit = Partit::find($acta->id_partit);

        $jugadorsEquipLocal = PartitJugador::
            join('plantilles', 'partit_jugadors.id_jugador', '=', 'plantilles.id_jugador')->
            where('partit_jugadors.id_partit', $partit->id)->
            where('plantilles.id_equip', $partit->id_equip_local)->
            where('minut_inici_posicio', 0)->
            get();

        $jugadorsEquipVisitant = PartitJugador::
            join('plantilles', 'partit_jugadors.id_jugador', '=', 'plantilles.id_jugador')->
            where('partit_jugadors.id_partit', $partit->id)->
            where('plantilles.id_equip', $partit->id_equip_visitant)->
            where('minut_inici_posicio', 0)->
            get();

        array_push($variables['mitja_total'], self::_getMitjaTotal($jugadorsEquipLocal), self::_getMitjaTotal($jugadorsEquipVisitant));
        array_push($variables['moral'], self::_getAtributEquip($jugadorsEquipLocal, ATRIBUT_MORAL), self::_getAtributEquip($jugadorsEquipVisitant, ATRIBUT_MORAL));
        array_push($variables['qualitat'], self::_getAtributEquip($jugadorsEquipLocal, ATRIBUT_QUALITAT), self::_getAtributEquip($jugadorsEquipVisitant, ATRIBUT_QUALITAT));
        array_push($variables['forma_fisica'], self::_getAtributEquip($jugadorsEquipLocal, ATRIBUT_FORMA_FISICA), self::_getAtributEquip($jugadorsEquipVisitant, ATRIBUT_QUALITAT));

        $variables['local'] = (($variables['mitja_total'][0] + $variables['moral'][0] + $variables['qualitat'][0] + $variables['forma_fisica'][0]) / 4) + VARIABLE_EQUIP_LOCAL;
        $variables['visitant'] = ($variables['mitja_total'][1] + $variables['moral'][1] + $variables['qualitat'][1] + $variables['forma_fisica'][1]) / 4;

        $resultatVariables = $variables['local'] - $variables['visitant'];

        $golsLocal = 0;
        $golsVisitant = 0;

        if($resultatVariables > 0 && $resultatVariables < 1)
        {
            $golsLocal++;
        }

        if($resultatVariables < 0 && $resultatVariables < -1)
        {
            $golsVisitant++;
        }

        app('db')->transaction(function() use(&$acta, &$golsLocal, &$golsVisitant) {

            $acta->gols_equip_local = $golsLocal + rand(0,1);
            $acta->gols_equip_visitant = $golsVisitant + rand(0,1);
            $acta->assistencia = 2600;
            $acta->partit_finalitzat = TRUE;

            $acta->save();

            for ($i = 0; $i < $golsLocal; $i++)
            {
                PartitGol::create([
                    'id_partit' => $acta->id_partit,
                    'id_jugador' => 5,
                    'minut' => 32,
                ]);
            }

            for ($i = 0; $i < $golsVisitant; $i++)
            {
                PartitGol::create([
                    'id_partit' => $acta->id_partit,
                    'id_jugador' => 346,
                    'minut' => 81,
                ]);
            }


        });

        $actaFinal = PartitActa::
            with('partit.gols')->
            find($acta->id);

        return $actaFinal;
    }

    private function _getMitjaTotal($equip)
    {
        $response = [];

        foreach ($equip as $jugador)
        {
            array_push($response, Jugador::find($jugador->id_jugador)->mitja);
        }

        return array_sum($response) / count($equip);
    }

    private function _getAtributEquip($equip, $atribut)
    {
        $response = [];

        foreach ($equip as $jugador)
        {
            array_push($response, JugadorAtribut::where('id_atribut', $atribut)->where('id_jugador', $jugador->id_jugador)->first()->valor);
        }

        return array_sum($response) / count($equip);
    }
}
