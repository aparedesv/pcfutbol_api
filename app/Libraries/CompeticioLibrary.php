<?php

namespace App\Libraries;

use Carbon\Carbon;
use App\Models\Partit;
use App\Models\Competicio;
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

            return Competicio::with('clubs')->find($id);

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

        $this->_novaCompeticio($competicio, $payload['id_equips']);

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
        $dataIniciPretemporada = new Carbon($competicio->temporada->inici);
        // $dataIniciTemporada = Carbon::parse($dataIniciPretemporada->addMonths(1))->getTranslatedDayName();
        $dataIniciTemporada = Carbon::parse($dataIniciPretemporada->addMonths(1))->format('Y-m-d');

        if($competicio->tipus->lliga == TRUE)
        {
            $this->_novaCompeticioPartitsLliga($competicio, $idEquips, $dataIniciTemporada);
        }

    }

    private function _novaCompeticioPartitsLliga($competicio, $idEquips, $dataIniciTemporada)
    {
        $equips = [];
        $partits = [];

        for($ii = 0; $ii < count($idEquips); $ii++)
        {

            for($aa = 1; $aa < count($idEquips); $aa++)
            {
                $idEquipLocal = $idEquips[$ii];
                $idEquipVisitant = $idEquips[$aa];

                if(!in_array($idEquipLocal, $equips) && $idEquipLocal <> $idEquipVisitant)
                {
                    $partit = [$idEquipLocal, $idEquipVisitant];
                    array_push($partits, $partit);
                    /* Partit::create([
                        'id_competicio' => $competicio->id,
                        'jornada' => $jornada,
                        'id_equip_local' => $idEquipLocal,
                        'id_equip_visitant' => $idEquipVisitant,
                        'id_camp' => 1,
                        'inici' => new Carbon($dataIniciTemporada),
                    ]); */
                }

                if($ii == 0 && count($equips) == 0)
                {
                    $partit = [$idEquipVisitant, $idEquipLocal];
                    array_push($partits, $partit);
                    /* Partit::create([
                        'id_competicio' => $competicio->id,
                        'jornada' => $jornada,
                        'id_equip_local' => $idEquipVisitant,
                        'id_equip_visitant' => $idEquipLocal,
                        'id_camp' => 1,
                        'inici' => new Carbon($dataIniciTemporada),
                    ]); */
                }

            }

            array_push($equips, $idEquipLocal);
        }

        $numeroJornades = ($competicio->tipus->numero_equips - 1) * 2;

        $jornada = 1;
        $cont = 1;
        foreach ($partits as $partit)
        {
            /* if($cont > 9)
            {
                $jornada++;
            } */

            Partit::create([
                'id_competicio' => $competicio->id,
                'jornada' => 1,
                'id_equip_local' => $partit[0],
                'id_equip_visitant' => $partit[1],
                'id_camp' => 1,
                'inici' => new Carbon($dataIniciTemporada),
            ]);

            $cont++;
        }
    }
}
