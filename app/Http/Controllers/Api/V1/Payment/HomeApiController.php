<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'hello there',
        ], 200);
    }
}
