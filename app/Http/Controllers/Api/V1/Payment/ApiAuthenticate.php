<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticate extends Controller
{
    public function index(Request $request)
    {
        $request->merge([
            'mobile' => preg_replace('/^(0|254)/', '+254', $request->get('phone'))
        ]);
        if (!Auth::attempt($request->only('mobile', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('mobile', $request->input('mobile'))->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
