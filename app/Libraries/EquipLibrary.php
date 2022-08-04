<?php

namespace App\Libraries;

use App\Models\Equip;

class EquipLibrary
{
    public function index()
    {
        return Equip::all();
    }

    public function show($id)
    {
        try {

            return Equip::
                with('club')->
                with('club.ciutat')->
                find($id);
        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        return Equip::create($payload);
    }

    public function update($id, $payload)
    {
        try {
            $equip = Equip::find($id);

            $equip->nom = $payload['nom'];
            $equip->id_club = $payload['id_club'];

            $equip->save();

            return $equip;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function destroy($id)
    {
        try {

            $equip = Equip::find($id);
            $equip->destroy($id);

            return $equip;

        } catch (\Throwable $th) {

            return NULL;
        }

    }
}
