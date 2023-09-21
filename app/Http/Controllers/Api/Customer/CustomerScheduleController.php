<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Venture;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $allSchedules = Schedule::where('user_id', $user->id)->get();
        return Response([
            'status'    => true,
            'message'   => 'All Schedule',
            'data'      => $allSchedules
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
        $validator = validator(
            $request->all(),
            [
                'venture_id'    => 'required|numeric|exists:ventures,id',
                'schedule_date' => 'required|date_format:Y-m-d|after:' . date('Y-m-d', strtotime("-1 days")),
                'schedule_time' => 'required|date_format:H:i',
            ],
            [
                'venture_id.required'       => 'Venture Info is Required',
                'venture_id.numeric'        => 'Provide Valid Venture Info',
                'venture_id.exists'         => 'Provide Valid Venture Info',
                'schedule_date.required'    => 'Sechude Date is Required',
                'schedule_date.date_format' => 'Sechude Date Format is YYYY-MM-DD',
                'schedule_date.after'       => 'Sechude Date not less than today',
                'schedule_time.required'    => 'Sechude Time is Required',
                'schedule_time.date_format' => 'Sechude Time Format is HH-MM',
                'schedule_time.after'       => 'Sechude Time not less than Now',
            ]
        );
        if ($validator->fails()) :
            return Response([
                'status'    => false,
                'message'   => $validator->getMessageBag()->first(),
                'errors'    => $validator->getMessageBag()
            ], Response::HTTP_BAD_REQUEST);
        else :
            $user = Auth::user();
            $ventureInfo = Venture::find($request->venture_id);

            $newSchedule = new Schedule;
            $newSchedule->venture_id = $request->venture_id;
            $newSchedule->user_id = $user->id;
            $newSchedule->schedule_title = "Schedule for " . $ventureInfo->venture_name;
            $newSchedule->schedule_date =  $request->schedule_date;
            $newSchedule->schedule_time =  $request->schedule_time;
            $newSchedule->schedule_description = 'Your appointment on ' . $request->schedule_date . ' at ' . $request->schedule_time . ' with so and so person for ' . $ventureInfo->venture_name;
            $newSchedule->save();

            return Response([
                'status'    => true,
                'message'   => 'Schedudle Created Successfully.',
                'data'      => $newSchedule
            ], Response::HTTP_CREATED);
        endif;
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
