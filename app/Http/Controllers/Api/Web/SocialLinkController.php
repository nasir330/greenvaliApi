<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialLinkController extends Controller
{
    public function socialLinks()
    {
        $data = SocialLink::get(['name', 'url'])->keyBy('name');

        return Response([
            'status'    => true,
            'message'   => 'All Slider',
            'data'      => $data
        ], Response::HTTP_OK);
    }
}
