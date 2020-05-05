<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseController extends Controller
{
    /**
     * Send a success response
     * 
     * @param $title Response title
     * @param $messages Response detailed message
     * @param $status Boolean, success or error
     * @param $code Status code
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendResponse(string $title = "", $messages = [], bool $status = true, int $code = 200)
    {
        $response = [
            'success' => $status,
            'data' => $title,
            'message' => $messages,
            'status' => $code
        ];

        return response()->json($response, $code);
    }
}
