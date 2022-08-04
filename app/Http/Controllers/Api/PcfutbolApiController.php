<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class PcfutbolApiController extends Controller
{
    // controlador pare de la API
    public function payload($payload)
    {
        $response = [];
        foreach ($payload as $key => $value)
        {
            $response[$key] = $value;
        }

        return $response;
    }

    public function checkIfExist($response)
    {
        if($response <> NULL)
        {
            return response($response);
        }
        else
        {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }
}
