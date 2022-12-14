<?php

namespace App\Libraries;

use App\Models\Ciutat;

class CiutatLibrary
{
    public function index()
    {
        return Ciutat::all();
    }

    public function show($id)
    {
        try {

            return Ciutat::with('clubs')->find($id);

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        return Ciutat::create($payload);
    }

    public function update($id, $payload)
    {
        try {

            $ciutat = Ciutat::find($id);

            $ciutat->nom = $payload['nom'];
            $ciutat->latitud = $payload['latitud'];
            $ciutat->longitud = $payload['longitud'];

            $ciutat->save();

            return $ciutat;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function destroy($id)
    {
        try {

            $ciutat = Ciutat::find($id);
            $ciutat->destroy($id);

            return $ciutat;

        } catch (\Throwable $th) {

            return NULL;
        }
    }
}
