<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Libraries\JugadorLibrary;

class JugadorApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->jugadorLibrary = new JugadorLibrary;
    }

    public function index()
    {
        return $this->jugadorLibrary->index();
    }

    public function show($id)
    {
        return self::checkIfExist($this->jugadorLibrary->show($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'cognoms' => 'required|max:100',
            'data_naixement' => 'required|date',
        ]);

        $payload = $this->payload($request->request);

        return $this->jugadorLibrary->store($payload);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'cognoms' => 'required|max:100',
            'data_naixement' => 'required|date',
        ]);

        $payload = $this->payload($request->request);

        return self::checkIfExist($this->jugadorLibrary->update($id, $payload));
    }

    public function destroy($id)
    {
        return self::checkIfExist($this->jugadorLibrary->destroy($id));
    }
}
