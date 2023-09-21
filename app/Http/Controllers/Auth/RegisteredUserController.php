<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminate\Http\Response;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',            
            'phone' => 'required|numeric|unique:user_infos,phone',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'role_id ' => 3,
            'first_name' => $request->name,
            'last_name' => 'User',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserInfo:: create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => 'NULL',
            'start_date' => 'NULL',
            'end_date' => 'NULL',
        ]);

        return response()->json([
            'message' => 'user created successfully',
        ]);
    }
}
