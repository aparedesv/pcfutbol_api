<?php

namespace App\Http\Controllers\Api;

use App\Models\Partit;
use Illuminate\Http\Request;
use App\Libraries\PartitLibrary;

class PartitApiController extends PcfutbolApiController
{
    public function __construct()
    {
        $this->partitLibrary = new PartitLibrary;
    }

    public function index()
    {
        return $this->partitLibrary->index();
    }

    public function show($id)
    {
        return self::checkIfExist($this->partitLibrary->show($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:100',
            'id_camp' => 'required|exists:camps,id',
            'inici' => 'required|date_format:"Y-m-d H:i"',
        ]);

        $payload = $this->payload($request->request);

        return self::checkIfExist($this->partitLibrary->update($id, $payload));
    }

    public function jugar(Request $request)
    {
        $payload = $this->payload($request->request);

        $id = $payload['id'];
        $id_equip = $payload['id_equip'];

        return self::_checkEquip($this->partitLibrary->jugar($id, $id_equip, self::_checkLocal($id, $id_equip)));
    }

    private function _checkEquip($response)
    {
        if($response <> NULL)
        {
            return response($response);
        }
        else
        {
            return response()->json([
                'message' => 'there are suspended or injured players!'
            ], 422);
        }
    }

    private function _checkLocal($id, $id_equip)
    {
        $response = NULL;

        if(Partit::where('id', $id)->where('id_equip_visitant', $id_equip)->first())
        {
            $response = TRUE;
        }

        return $response;

    }
}
