<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebSliderController extends Controller
{
    public function allSliders()
    {
        $data = Slider::orderBy('id', 'DESC')->get(['id', 'image']);
        return Response([
            'status'    => true,
            'message'   => 'All Slider',
            'data'      => $data
        ], Response::HTTP_OK);
    }
}
