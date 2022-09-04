<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Libraries\ClubLibrary;

class ClubApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->clubLibrary = new ClubLibrary;
    }

    public function index()
    {
        return $this->clubLibrary->index();
    }

    public function show($id)
    {
        return self::checkIfExist($this->clubLibrary->show($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'id_ciutat' => 'required|exists:ciutats,id',
        ]);

        $payload = $this->payload($request->request);

        return $this->clubLibrary->store($payload);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'id_ciutat' => 'required|exists:ciutats,id',
        ]);

        $payload = $this->payload($request->request);

        return self::checkIfExist($this->clubLibrary->update($id, $payload));
    }

    public function destroy($id)
    {
        return self::checkIfExist($this->clubLibrary->destroy($id));
    }
}
