<?php

namespace App\Libraries;

use App\Models\Jugador;

class JugadorLibrary
{
    public function index()
    {
        return Jugador::all();
    }

    public function show($id)
    {
        try {

            return Jugador::
                with('equip')->
                with('posicions')->
                with('atributs')->
                find($id);
        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        return Jugador::create($payload);
    }

    public function update($id, $payload)
    {
        try {
            $equip = Jugador::find($id);

            $equip->nom = $payload['nom'];
            $equip->cognoms = $payload['cognoms'];
            $equip->data_naixement = $payload['data_naixement'];

            $equip->save();

            return $equip;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function destroy($id)
    {
        try {

            $equip = Jugador::find($id);
            $equip->destroy($id);

            return $equip;

        } catch (\Throwable $th) {

            return NULL;
        }

    }
}
