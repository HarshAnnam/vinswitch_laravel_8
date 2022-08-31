<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SofiaRateplan;
use App\Providers\EncreptDecrept;
use Illuminate\Support\Facades\Validator;

class SofiaRateplanController extends Controller
{
    public function SofiaRateplan(Request $request)
    {
        $perpage = 2;
        $sofiarateplan = SofiaRateplan::orderBy('id', 'DESC');
        $sofiarateplan = $sofiarateplan->select('sofia_rateplan.*', 'sofia_rateplan.id as id');

        // if ($request->ajax()) {
        //     if ($request->search) {
        //         $search_key = $request->search;
        //         // dd("hi");
        //         $gateways->where(function ($gateway1) use ($search_key) {
        //             $gateway1 = $gateway1->where('gateways.gateway_name', 'LIKE', "%{$search_key}%")->orWhere('gateways.proxy', 'LIKE', "%{$search_key}%")->orWhere('gateways.expire_seconds', 'LIKE', "%{$search_key}%")->orWhere('gateways.register', 'LIKE', "%{$search_key}%")->orWhere('gateways.outbound_default', 'LIKE', "%{$search_key}%");
        //         });
        //     }
        // }

        $sofiarateplan = $sofiarateplan->paginate($perpage);
        if ($request->ajax()) {
            $response_part['records'] = $sofiarateplan;
            $response_part['page'] = 'sofiarateplan';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;
            return response()->json($response_ajex);
        }
        $response['records'] = $sofiarateplan;
        // dd($response['records']);
        return view('sofiarateplan.index', $response);
    }

    



    
}
