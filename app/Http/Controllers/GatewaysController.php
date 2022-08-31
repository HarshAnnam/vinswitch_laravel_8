<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gateways;
use App\Providers\EncreptDecrept;
use Illuminate\Support\Facades\Validator;

class GatewaysController extends Controller
{
    public function gateways(Request $request)
    {
        $perpage = 4;
        $gateways = Gateways::orderBy('id', 'DESC');
        $gateways = $gateways->select('gateways.*', 'gateways.id as id');

        if ($request->ajax()) {
            if ($request->search) {
                $search_key = $request->search;
                // dd("hi");
                $gateways->where(function ($gateway1) use ($search_key) {
                    $gateway1 = $gateway1->where('gateways.gateway_name', 'LIKE', "%{$search_key}%")->orWhere('gateways.proxy', 'LIKE', "%{$search_key}%")->orWhere('gateways.expire_seconds', 'LIKE', "%{$search_key}%")->orWhere('gateways.register', 'LIKE', "%{$search_key}%")->orWhere('gateways.outbound_default', 'LIKE', "%{$search_key}%");
                });
            }
        }

        $gateways = $gateways->paginate($perpage);
        if ($request->ajax()) {
            $response_part['records'] = $gateways;
            $response_part['page'] = 'gateways';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;
            return response()->json($response_ajex);
        }
        $response['records'] = $gateways;
        // dd($response['records']);
        return view('gateways.index', $response);
    }

    public function gateway_add_ajex(Request $request)
    {
        // dd("hi");
        $error = 0;
        $validator = Validator::make($request->all(), [
            'gateway_name' => 'required',
            'proxy' => 'required',
            'retry_seconds' => 'required',
            'expire_seconds' => 'required'   
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }
        $gateways['gateway_name'] = $request->gateway_name;
        $gateways['prefix'] = $request->prefix;
        $gateways['username'] = $request->username;
        $gateways['password'] = $request->password;
        $gateways['auth_username'] = $request->auth_username;
        $gateways['realm'] = $request->realm;
        $gateways['from_user'] = $request->from_user;
        $gateways['from_domain'] = $request->from_domain;
        $gateways['proxy'] = $request->proxy;
        $gateways['register_proxy'] = $request->register_proxy;
        $gateways['outbound_proxy'] = $request->outbound_proxy;
        $gateways['expire_seconds'] = $request->expire_seconds;
        $gateways['register'] = $request->register;
        $gateways['retry_seconds'] = $request->retry_seconds;
        $gateways['ping'] = $request->ping;
        $gateways['caller_id_in_from'] = $request->caller_id_in_from;
        $gateways['channels'] = $request->channels;
        $gateways['hostname'] = $request->hostname;
        $gateways['outbound_default'] = $request->outbound_default;

        try {
            $add_gateways = Gateways::create($gateways);
            if ($add_gateways && $inserted_id = $add_gateways->id) {
                return response()->json(["status" => "success", "data" => "Gateway Added Successfully " . $inserted_id, "error" => $error]);
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        return response()->json(["status" => "fail", "data" => "Gateway Added Fail", "error" => $error]);
    }



    public function gateways_update_ajex(Request $request)
    {
        // dd($request);
        $id = EncreptDecrept::decrept($request->id);
        if (Gateways::where("id", $id)->count() == 0) {
            return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
        }
        $columnindex = $request->columnindex;
        $value = $request->value;

        if ($columnindex == "register") {
            $update["register"] = ($value == 'TRUE') ? 'FALSE' : 'TRUE';
        }

        try {
            // $update["modified_at"] = date('Y-m-d H:i:s');
            $User_Update = Gateways::where("id", $id)->update($update);
            if ($User_Update) {
                return response()->json(["status" => "success", "data" => "Update Sucessfully ", "error" => 0]);
            }

            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }
}
