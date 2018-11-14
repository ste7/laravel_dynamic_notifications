<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\User;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request) {
        $user = User::create($request->all());

        return response()->json([
            'user' => $user
        ], 200);
    }
}
