<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Libraries\EquipLibrary;

class EquipApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->equipLibrary = new EquipLibrary;
    }

    public function index()
    {
        return $this->equipLibrary->index();
    }

    public function show($id)
    {
        return self::checkIfExist($this->equipLibrary->show($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'id_club' => 'required|exists:clubs,id',
        ]);

        $payload = $this->payload($request->request);

        return $this->equipLibrary->store($payload);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'id_club' => 'required|exists:clubs,id',
        ]);

        $payload = $this->payload($request->request);

        return self::checkIfExist($this->equipLibrary->update($id, $payload));
    }

    public function destroy($id)
    {
        return self::checkIfExist($this->equipLibrary->destroy($id));
    }
}
