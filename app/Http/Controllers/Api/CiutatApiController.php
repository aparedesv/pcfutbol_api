<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Libraries\CiutatLibrary;

class CiutatApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->ciutatLibrary = new CiutatLibrary;
    }

    public function index()
    {
        return $this->ciutatLibrary->index();
    }

    public function show($id)
    {
        return self::checkIfExist($this->ciutatLibrary->show($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'longitud' => 'required',
            'latitud' => 'required'
        ]);

        $payload = $this->payload($request->request);

        return $this->ciutatLibrary->store($payload);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'longitud' => 'required',
            'latitud' => 'required'
        ]);

        $payload = $this->payload($request->request);

        return self::checkIfExist($this->ciutatLibrary->update($id, $payload));
    }

    public function destroy($id)
    {
        return self::checkIfExist($this->ciutatLibrary->destroy($id));
    }
}
