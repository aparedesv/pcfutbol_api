<?php

namespace App\Http\Controllers\Api;

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
        return $this->checkIfExist($this->partitLibrary->show($id));
    }
}
