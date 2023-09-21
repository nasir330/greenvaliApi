<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Staff;
use App\Models\User;
use App\Models\Venture;
use App\Models\VenturePlot;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $allVentures        = Venture::all()->count();
        $allVenturePlots    = VenturePlot::all()->count();
        $allAdmin           = User::where('role_id', 1)->get()->count();
        $allCustomers       = User::where('role_id', 3)->get()->count();
        $allStaffs          = User::where('role_id', 2)->get()->count();

        return Inertia::render('Dashboard', [
            'summary' => array(
                'numberOfVentures'      => $allVentures,
                'numberOfVenturePlots'  => $allVenturePlots,
                'numberOfAdmin'         => $allAdmin,
                'numberOfCustomers'     => $allCustomers,
                'numberOfStaff'         => $allStaffs,
            )
        ]);
    }
}
