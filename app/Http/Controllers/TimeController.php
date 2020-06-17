<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TimeController extends Controller
{
    /**
     *
     * @param string $time
     * @return Response
     */
    public function __invoke(string $time)
    {
        return response()->json([
            'time' => $time,
        ]);
    }
}
