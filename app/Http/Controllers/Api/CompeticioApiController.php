<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Libraries\CompeticioLibrary;

class CompeticioApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->competicioLibrary = new CompeticioLibrary;
    }

    public function index()
    {
        return $this->competicioLibrary->index();
    }

    public function show($id)
    {
        return self::checkIfExist($this->competicioLibrary->show($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:50',
            'id_tipus' => 'required',
            'id_temporada' => 'required',
            'id_equips' => 'required|array'
        ]);

        $payload = $this->payload($request->request);

        return $this->competicioLibrary->store($payload);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:50',
            'id_tipus' => 'required',
            'id_temporada' => 'required',
        ]);

        $payload = $this->payload($request->request);

        return self::checkIfExist($this->competicioLibrary->update($id, $payload));
    }

    public function destroy($id)
    {
        return self::checkIfExist($this->competicioLibrary->destroy($id));
    }
}
