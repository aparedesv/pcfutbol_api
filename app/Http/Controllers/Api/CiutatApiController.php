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
        return response($this->ciutatLibrary->index());
    }

    public function show($id)
    {
        return response($this->ciutatLibrary->show($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'longitud' => 'required',
            'latitud' => 'required'
        ]);

        $payload = $this->payload($request->request);

        return response($this->ciutatLibrary->store($payload));
    }
}
