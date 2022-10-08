<?php

namespace App\Libraries;

use App\Models\Partit;

class JornadaLibrary
{
    public function show($id_competicio, $num_jornada)
    {
        try {

            $jornada = Partit::
                with('equipLocal')->
                with('equipVisitant')->
                where('id_competicio', $id_competicio)->
                where('jornada', $num_jornada)->
                get();

            if($jornada->isEmpty())
            {
                return NULL;
            }

            return $jornada;

        } catch (\Throwable $th) {

            return NULL;
        }
    }
}
