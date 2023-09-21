<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerVentureList;
use App\Http\Resources\Customer\VentureDetialResource;
use App\Models\Venture;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerVentureController extends Controller
{
    public function allVentureItems()
    {
        $data = Venture::withCount(['saleVenturePlots', 'availableVenturePlots'])->where('active_status', 1)->orderBy('id', 'DESC')->get();

        return Response([
            'status'    => true,
            'message'   => 'All Ventures',
            'data'      => CustomerVentureList::collection($data)
        ], Response::HTTP_OK);
    }

    public function ventureDetialById(string $id)
    {
        $data = Venture::withCount(['saleVenturePlots', 'availableVenturePlots'])->with('venturePlotImages')->where('active_status', 1)->findOrFail($id);

        return Response([
            'status'    => true,
            'message'   => 'Ventures Details',
            'data'      => new VentureDetialResource($data)
        ], Response::HTTP_OK);
    }
}
