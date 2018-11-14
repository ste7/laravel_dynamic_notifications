<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordEmailRequest;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset
     *
     * @param PasswordEmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(PasswordEmailRequest $request) {
        $user = User::where('email', $request->email)->first();

        if (! $user)
            return response()->json([
                'errors' => 'We can`t find a user with that e-mail address.'
            ], 404);

        $passwordReset = PasswordReset::updateOrCreate(['email' => $user->email],
            ['email' => $user->email, 'token' => str_random(60)]);
        if ($user && $passwordReset)
            $user->notify(new PasswordResetRequest($passwordReset->token));
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ], 200);
    }

    /**
     * Find token password reset
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($token) {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }

    /**
     * Reset password
     *
     * @param \App\Http\Requests\PasswordResetRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(\App\Http\Requests\PasswordResetRequest $request) {
        $passwordReset = PasswordReset::where($request->except('password_confirmation'))->first();

        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where($request->all('email'))->first();
        if (!$user)
            return response()->json([
                'message' => 'We can`t find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));

        return response()->json($user);
    }
}
