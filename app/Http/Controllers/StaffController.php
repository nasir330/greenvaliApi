<?php

namespace App\Http\Controllers;

use App\Http\Requests\Staff\StaffStoreRequest;
use App\Http\Requests\Staff\StaffUpdateRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = Staff::orderBy('id', 'DESC')->get();
        return Inertia::render('Staff/List', [
            'staffs' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Staff/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffStoreRequest $request)
    {
        $newStaff = new Staff;
        $newStaff->staff_name = $request->staff_name;
        $newStaff->staff_phone = $request->staff_phone;
        $newStaff->staff_address = $request->staff_address;
        $newStaff->staff_start_date = $request->staff_start_date;
        $newStaff->staff_end_date = $request->staff_end_date;
        $newStaff->staff_active_status = $request->staff_active_status;
        $newStaff->save();

        return Redirect::route('staffs.index')->with(['status' => 'success', 'message' => 'Staff Created Successfully']);
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
    public function edit(Staff $staff)
    {
        return Inertia::render('Staff/Edit', [
            'staff' => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffUpdateRequest $request, Staff $staff)
    {
        // dd($request->all());
        $staff->update([
            'staff_name'            => $request->staff_name,
            'staff_phone'           => $request->staff_phone,
            'staff_address'         => $request->staff_address,
            'staff_start_date'      => $request->staff_start_date,
            'staff_end_date'        => $request->staff_end_date,
            'staff_active_status'   => $request->staff_active_status
        ]);

        return Redirect::route('staffs.index')->with(['status' => 'success', 'message' => 'Staff Update Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return Redirect::route('staffs.index')->with(['status' => 'success', 'message' => 'Staff Deleted Successfully']);
    }
}
