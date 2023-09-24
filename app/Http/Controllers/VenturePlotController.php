<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenturePlot\VenturePloatImageUploadRequest;
use App\Http\Requests\VenturePlot\VenturePlotUpdateRequest;
use App\Models\User;
use App\Models\Venture;
use App\Models\VenturePlot;
use App\Models\VenturePlotImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class VenturePlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $data = VenturePlot::query()
        ->when($request->search, function ($query, $search) {
            $query->where('plot_name', 'like', '%' . $search . '%');
        })
        ->with(['venturePlotCustomer', 'venturePlotStaff'])->whereHas('ventureInfo', function ($query) {
            $query->where('active_status', 1);
        })->with('ventureInfo')->paginate(10);

        return Inertia::render('VenturePlot/List', [
            'venture_plots' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $allCustomers = User::where('role_id', 3)->where('active_status', 1)->orderBy('id', 'DESC')->get(['id', DB::raw("CONCAT(`first_name`, ' ', `last_name`, ' (', `email`, ')') AS name")]);
        // $allCustomers = User::with('userInfo')->where('role_id', 3)->where('active_status', 1)->orderBy('id', 'DESC')->get(['id', 'first_name', 'last_name', 'email']);
        $allEmployee = User::where('role_id', 2)->where('active_status', 1)->orderBy('id', 'DESC')->get(['id', 'first_name', 'last_name', 'email']);
        // $venturePlot->load('venturePlotImages');
        $veturePlot = VenturePlot::where('venture_id', $id)
        ->orderByDesc('plot_id') // Order by plot_id in descending order to get the maximum value
        ->first(); // Retrieve the first row (which will have the maximum plot_id)
    //    dd($veturePlot);
        return Inertia::render('VenturePlot/create', [
            'venture_plot'=> $veturePlot,
            // 'venture_plot'  => $venturePlot,
            'all_customers' => $allCustomers,
            'all_staffs'    => $allEmployee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
         $ventureData =  Venture::where('id', $request->venture_id)->first();
         $numberOfPlot = $ventureData->number_of_plot;
         $numberOfUpdatePlot = $ventureData->number_of_plot+$request->number_of_plot;
        Venture::where('id', $request->venture_id)->update([
            'number_of_plot'=> $numberOfUpdatePlot,
        ]);
        //  dd($ventureData);       
        for ($i = 1; $i <= $request->number_of_plot; $i++) {
            $newVenturePlot = new VenturePlot;
            $newVenturePlot->venture_id = $request->venture_id;
            $newVenturePlot->plot_id =$numberOfPlot+$i;
            $newVenturePlot->plot_name = $ventureData->venture_name . '-Plot Id-' . $numberOfPlot+$i;
            $newVenturePlot->save();
        }
        return Redirect::route('venture-plots.index')->with(['status' => 'success', 'message' => 'Venture Plot created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(VenturePlot $venturePlot)
    {
        dd($venturePlot);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VenturePlot $venturePlot)
    {
        $allCustomers = User::where('role_id', 3)->where('active_status', 1)->orderBy('id', 'DESC')->get(['id', DB::raw("CONCAT(`first_name`, ' ', `last_name`, ' (', `email`, ')') AS name")]);
        // $allCustomers = User::with('userInfo')->where('role_id', 3)->where('active_status', 1)->orderBy('id', 'DESC')->get(['id', 'first_name', 'last_name', 'email']);
        $allEmployee = User::where('role_id', 2)->where('active_status', 1)->orderBy('id', 'DESC')->get(['id', 'first_name', 'last_name', 'email']);
        $venturePlot->load('venturePlotImages');

        return Inertia::render('VenturePlot/Edit', [
            'venture_plot'  => $venturePlot,
            'all_customers' => $allCustomers,
            'all_staffs'    => $allEmployee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VenturePlotUpdateRequest $request)
    {
        $ventureInfo = VenturePlot::findOrFail($request->plot_id);

        $ventureInfo->plot_name = $request->plot_name;
        $ventureInfo->number_of_square_feet = $request->number_of_square_feet;
        $ventureInfo->total_price = $request->total_price;
        $ventureInfo->customer_id = $request->customer_id;
        $ventureInfo->staff_id = $request->staff_id;
        $ventureInfo->sale_date = $request->sale_date;
        if (!is_null($request->handover_date)) :
            $ventureInfo->handover_date = $request->handover_date;
        endif;
        $ventureInfo->plot_status = 1;
        $ventureInfo->save();

        return Redirect::route('venture-plots.index')->with(['status' => 'success', 'message' => 'Venture Plot Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VenturePlot $venturePlot): RedirectResponse
    {
        $ventureInfo = Venture::find($venturePlot->venture_id);
        $ventureInfo->number_of_plot = ($ventureInfo->number_of_plot - 1);
        $ventureInfo->save();

        $venturePlot->delete();
        return Redirect::route('venture-plots.index')->with(['status' => 'success', 'message' => 'Venture Plot Deleted Successfully']);
    }

    public function venturePlotImageUpload(VenturePloatImageUploadRequest $request)
    {
        $newVenturePloatImage = new VenturePlotImage;
        $newVenturePloatImage->venture_id = $request->venture_id;
        $newVenturePloatImage->venture_plot_id = $request->venture_plot_id;

        $file = $request->file('plot_image');
        $fileExtension = $request->plot_image->extension();
        $fileName = Str::slug($request->venture_name) . "_" . Str::random(5) . "_" . date('his') . '.' . $fileExtension;
        $folderpath = public_path() . '/venture-plot/';
        $file->move($folderpath, $fileName);
        $newVenturePloatImage->plot_image = '/venture-plot/' . $fileName;

        $saveVenturePlotImage = $newVenturePloatImage->save();

        return Redirect::back()->with(['status' => 'success', 'message' => 'Venture Plot Image Uploaded']);
    }
}
