<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $query = User::with(['userRole', 'userInfo']);

        if ($request->type == 'employee') :
            $query->where('role_id', 2);
        elseif ($request->type == 'customer') :
            $query->where('role_id', 3);
        elseif ($request->type == 'driver') :
            $query->where('role_id', 5);
        elseif ($request->type == 'all' || is_null($request->type)) :
            $query->whereIn('role_id', [1, 2, 3]);
        endif;

        $data = $query->orderBy('id', 'ASC')->get();

        return Response([
            'status'    => true,
            'message'   => 'All Users',
            'data'      => $data
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
