<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $validator = validator(
            $request->all(),
            [
                'email'     => 'required|email|max:255',
                'password'  => 'required|string|max:255'
            ],
            [
                'email.required'    => 'Email is Required',
                'email.email'       => 'Provide Valid Email',
                'email.max'         => 'Provide Valid Email',
                'password.required' => 'Password is Required',
                'password.string'   => 'Provide Valid Password',
                'password.max'      => 'Provide Valid Password',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'message'   => $validator->getMessageBag()->first(),
                'errors'    => $validator->getMessageBag()
            ]);
        } else {
            $checkEmailExists = User::where('email', $request->email)->exists();

            if ($checkEmailExists) {
                if (Auth::attempt($request->only(['email', 'password']))) {
                    $user = Auth::user();
                    $user->load(['userRole', 'userInfo']);
                    return response()->json([
                        'status'        => true,
                        'message'       => 'Logged in successfully',
                        'user'          => $user,
                        'access_token'  => $user->createToken($user->email)->plainTextToken
                    ], 200);
                } else {
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Email & Password not Match',
                    ], 401);
                }
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Email Not Exists.',
                ], 400);
            }
        }
    }

    public function user()
    {
        $user = Auth::user();
        $user->load('userInfo');

        return response()->json([
            'status'        => true,
            'message'       => 'User Details',
            'user'          => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return response()->json([
            'status'        => true,
            'message'       => 'Logout Successfully'
        ], 200);
    }
}
