<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\SliderImageUploadRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = Slider::orderBy('id', 'DESC')->get();
        return Inertia::render('Slider/List', [
            'sliders' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Slider/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderImageUploadRequest $request)
    {
        $newSlider = new Slider;

        $file = $request->file('image');
        $fileExtension = $request->image->extension();
        $fileName = Str::random(5) . "_" . date('his') . '.' . $fileExtension;
        $folderpath = public_path() . '/slider';
        $file->move($folderpath, $fileName);
        $newSlider->image = '/slider/' . $fileName;
        $newSlider->save();

        return Redirect::route('sliders.index')->with(['status' => 'success', 'message' => 'Slider Added Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        File::delete(public_path($slider->image));
        $slider->delete();
        return Redirect::route('sliders.index')->with(['status' => 'success', 'message' => 'Slider Deleted Successfully']);
    }
}
