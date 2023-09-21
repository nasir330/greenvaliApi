<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with(['userRole', 'userInfo'])->orderBy('id', 'ASC')->get();
        return Inertia::render('User/List', [
            'users' => $data
        ]);
    }

    public function adminlist()
    {
        $data = User::where('role_id ',1)->with(['userRole', 'userInfo'])->orderBy('id', 'ASC')->get();
        return Inertia::render('User/List', [
            'users' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = UserRole::all();
        return Inertia::render('User/Add', [
            'user_roles' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $newUser = new User;

        $newUser->role_id       = $request->role_id;
        $newUser->first_name    = $request->first_name;
        $newUser->last_name     = $request->last_name;
        $newUser->email         = $request->email;
        $newUser->password      = Hash::make($request->password);
        $newUser->active_status = $request->active_status;
        $newUser->save();

        $newUserInfo = new UserInfo;
        $newUserInfo->user_id   = $newUser->id;
        $newUserInfo->phone   = $request->phone;
        $newUserInfo->address   = $request->address;
        if (!is_null($request->start_date)) :
            $newUserInfo->start_date   = $request->start_date;
        endif;
        if (!is_null($request->start_date)) :
            $newUserInfo->end_date   = $request->end_date;
        endif;
        $newUserInfo->save();

        return Redirect::route('users.index')->with(['status' => 'success', 'message' => 'User Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = $user->load(['userRole', 'userInfo']);
        $data = UserRole::all();
        return Inertia::render('User/Edit', [
            'user'          => $user,
            'user_roles'    => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->role_id       = $request->role_id;
        $user->first_name    = $request->first_name;
        $user->last_name     = $request->last_name;
        $user->email         = $request->email;
        if ($request->filled('password')) {
            $user->password      = Hash::make($request->password);
        }
        $user->active_status = $request->active_status;
        $user->save();

        $user->userInfo->phone  = $request->phone;
        $user->userInfo->address  = $request->address;
        if (!is_null($request->start_date)) :
            $user->userInfo->start_date   = $request->start_date;
        endif;
        if (!is_null($request->start_date)) :
            $user->userInfo->end_date   = $request->end_date;
        endif;
        $user->userInfo->save();

        return Redirect::route('users.index')->with(['status' => 'success', 'message' => 'User Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
    
        // Delete related records in the user_infos table
        $user->userInfo()->delete();
    
        // Now delete the user
        $user->delete();
    
        return Redirect::route('users.index')->with(['status' => 'success', 'message' => 'User Deleted Successfully']);
    }
    
}
