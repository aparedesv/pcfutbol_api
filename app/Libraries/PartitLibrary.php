<?php

namespace App\Libraries;

use App\Models\Partit;

class PartitLibrary
{
    public function index()
    {
        return Partit::orderBy('id_competicio')->orderBy('jornada')->get();
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
