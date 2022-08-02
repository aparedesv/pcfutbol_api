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
        return Ciutat::find($id);
    }

    public function store($payload)
    {
        return Ciutat::create($payload);
    }
}
