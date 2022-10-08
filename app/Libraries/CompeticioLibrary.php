<?php

namespace App\Libraries;

use Carbon\Carbon;
use App\Models\Partit;
use App\Models\Competicio;
use App\Models\PartitActa;
use App\Models\TipusCompeticio;

class CompeticioLibrary
{
    public function index()
    {
        return Competicio::all();
    }

    public function show($id)
    {
        try {

            return Competicio::with('partits')->find($id);

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        $tipus = TipusCompeticio::find($payload['id_tipus']);

        if(count($payload['id_equips']) <> $tipus->numero_equips)
        {
            return response()->json([
                'message' => 'Teams fail!'
            ], 422);
        }

        $competicio = Competicio::create($payload);

        self::_novaCompeticio($competicio, $payload['id_equips']);

        return $competicio;
    }

    public function update($id, $payload)
    {
        try {

            $competicio = Competicio::find($id);

            $competicio->nom = $payload['nom'];
            $competicio->id_tipus = $payload['id_tipus'];
            $competicio->id_temporada = $payload['id_temporada'];

            $competicio->save();

            return $competicio;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function destroy($id)
    {
        try {

            $competicio = Competicio::find($id);
            $competicio->destroy($id);

            return $competicio;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    private function _novaCompeticio($competicio, $idEquips)
    {
        if($competicio->tipus->lliga == TRUE)
        {
            self::_novaCompeticioPartitsLliga($competicio, $idEquips);
        }
    }

    private function _novaCompeticioPartitsLliga($competicio, $idEquips)
    {
        app('db')->transaction(function() use(&$competicio, &$idEquips) {

            for($round = 0; $round < count($idEquips) - 1; ++$round)
            {
                self::_setRoundPairs($idEquips, $round + 1, $competicio);
                $idEquips = self::_rotateCompetitors($idEquips);
            }
        });
    }

    private function _setRoundPairs($teams, $round, $competicio)
    {
        // anada
        $dataIniciPretemporada = new Carbon($competicio->temporada->inici);

        $dataIniciTemporada = Carbon::parse($dataIniciPretemporada->addMonths(1));
        $dataPartitAnada = $dataIniciTemporada->addWeeks($round - 1);

        $dataIniciTemporada = Carbon::parse($dataIniciPretemporada);
        $dataPartitTornada = $dataIniciTemporada->addWeeks(($round - 1) + (count($teams) - 1));

        for($i = 0 ; $i < count($teams)/2 ; ++$i)
        {
            $opponent = count($teams) - 1 - $i;

            $local = $teams[$i];
            $visitant = $teams[$opponent];

            if($round % 2 == 0)
            {
                $local = $visitant;
                $visitant = $teams[$i];
            }

            $partitPrimeraVolta = Partit::create([
                'id_competicio' => $competicio->id,
                'jornada' => $round,
                'id_equip_local' => $local,
                'id_equip_visitant' => $visitant,
                'inici' => $dataPartitAnada,
            ]);

            PartitActa::create([
               'id_partit' => $partitPrimeraVolta->id
            ]);

            $partitSegonaVolta = Partit::create([
                'id_competicio' => $competicio->id,
                'jornada' => $round + (count($teams) - 1),
                'id_equip_local' => $visitant,
                'id_equip_visitant' => $local,
                'inici' => $dataPartitTornada,
            ]);

            PartitActa::create([
                'id_partit' => $partitSegonaVolta->id
             ]);
        }
    }

    private function _rotateCompetitors($teams)
    {
        $result = $teams;

        $tmp = $result[ count($result) - 1 ];
        for($i = count($result)-1; $i > 1; --$i)
        {
            $result[$i] = $result[$i-1];
        }
        $result[1] = $tmp;

        return $result;

    }
}
