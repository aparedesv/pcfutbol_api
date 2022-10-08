<?php

namespace App\Http\Controllers\Api;

use App\Libraries\JornadaLibrary;

class JornadaApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->jornadaLibrary = new JornadaLibrary;
    }

    public function show($id_competicio, $num_jornada)
    {
        return self::checkIfExist($this->jornadaLibrary->show($id_competicio, $num_jornada));
    }
}
