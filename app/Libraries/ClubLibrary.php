<?php

namespace App\Libraries;

use App\Models\Club;

class ClubLibrary
{
    public function index()
    {
        return Club::all();
    }

    public function show($id)
    {
        try {

            return Club::with('ciutat')->find($id);

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function store($payload)
    {
        return Club::create($payload);
    }

    public function update($id, $payload)
    {
        try {
            $club = Club::find($id);

            $club->nom = $payload['nom'];
            $club->id_ciutat = $payload['id_ciutat'];

            $club->save();

            return $club;

        } catch (\Throwable $th) {

            return NULL;
        }
    }

    public function destroy($id)
    {
        try {

            $club = Club::find($id);
            $club->destroy($id);

            return $club;

        } catch (\Throwable $th) {

            return NULL;
        }

    }
}
