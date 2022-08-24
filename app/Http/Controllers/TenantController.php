<?php

namespace App\Http\Controllers;

use App\Models\BillPlan;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\EncreptDecrept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    // customers list Telnet list
    public function customers(Request $request)
    {
        
        $agent_id = $request->id ? $request->id : '';
        $id = EncreptDecrept::decrept($agent_id); 
        $perpage = 4;
        $tenant = Tenant::orderBy('id', 'DESC');
        $activetenant = Tenant::where('status', 'ACTIVE');
        $suspendedtenant = Tenant::where('suspended', 'YES');
        if(!empty($id)){
            $tenant = $tenant->where("agent_id",$id);
            $activetenant = $activetenant->where("agent_id",$id);
            $suspendedtenant = $suspendedtenant->where("agent_id",$id);
        }
        $response['billplan_list'] = BillPlan::get();
        if ($request->ajax()) {
            if ($request->search) {
                $search_key = $request->search;
                $tenant->where(function ($tenant1) use ($search_key) {
                    $tenant1 = $tenant1->where('first_name', 'LIKE', "%{$search_key}%")->orWhere('last_name', 'LIKE', "%{$search_key}%")->orWhere('email', 'LIKE', "%{$search_key}%")->orWhere('company_name', 'LIKE', "%{$search_key}%");
                });
                $activetenant->where(function ($activetenant1) use ($search_key) {
                    $activetenant1 = $activetenant1->where('first_name', 'LIKE', "%{$search_key}%")->orWhere('last_name', 'LIKE', "%{$search_key}%")->orWhere('email', 'LIKE', "%{$search_key}%")->orWhere('company_name', 'LIKE', "%{$search_key}%");
                });
                $suspendedtenant->where(function ($suspendedtenant1) use ($search_key) {
                    $suspendedtenant1 = $suspendedtenant1->where('first_name', 'LIKE', "%{$search_key}%")->orWhere('last_name', 'LIKE', "%{$search_key}%")->orWhere('email', 'LIKE', "%{$search_key}%")->orWhere('company_name', 'LIKE', "%{$search_key}%");
                });
            }
        }


        $tenant = $tenant->paginate($perpage);

        if ($request->ajax()) {
            $response_ajex['totalrecords'] = $tenant->total();
            $response_part['records'] = $tenant;
            $response_part['page'] = 'tenant';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;
            $response_ajex['activetenant'] = $activetenant->count();
            $response_ajex['suspendedtenant'] = $suspendedtenant->count();
            return response()->json($response_ajex);
        }

        $response['records'] = $tenant;
        $response['agent_id'] = $agent_id;
        $response['totalrecords'] = $tenant->total();
        $response['activetenant'] = $activetenant->count();
        $response['suspendedtenant'] = $suspendedtenant->count();
        // dd($response);
        return view('tenant.index', $response);
    }

    // customer add model - add cusomer 
    public function customersAddAjex(Request $request){
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email',
            'contact_no' => 'required|digits:10',
            'address' => 'required|min:5',
            'country' => 'required|min:2',
            'state' => 'required|min:2',
            'city' => 'required|min:2',
            'postal_code' => 'required|min:5',
            'company_name' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }

        $update["account_number"] = "";
        // $update["agent_id"] = Auth::user()->id;
        $update["first_name"] = $request->firstname;
        $update["last_name"] = $request->lastname;
        $update["email"] = $request->email;
        $update["phone_number"] = $request->contact_no;
        $update["address"] = $request->address;
        $update["country"] = $request->country;
        $update["state"] = $request->state;
        $update["city"] = $request->city;
        $update["postal_code"] = $request->postal_code;
        $update["company_name"] = $request->company_name;
        
        
        try {
            if ($request->id == 0) {
                $update["join_date"] = date("Y-m-d");
                $add_tenant = Tenant::create($update);

                // $role[] = 'TENANT';
                // $add_tenant->assignRole($role);
                if ($inserted_id = $add_tenant->id) {
                    return response()->json(["status" => "success", "data" => $inserted_id, "error" => 0]);
                }
            } else {
                $update["modified_at"] = date('Y-m-d H:i:s');
                Tenant::where("id", $request->id)->update($update);
                return response()->json(["status" => "success", "data" => "Update Sucessfully", "error" => 0]);
            }


            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }
    // customers Edit Telnet Edit
    public function customersedit($id){
        // dd($id);
        $perpage = 3;
        $decrypted_id = EncreptDecrept::decrept($id);
        $id = $decrypted_id;
        if (Tenant::where("id", $decrypted_id)->count() == 0) {
            return redirect('/customers');
        }
        // dd($id);
        
        // $id = $decrypted_id[0];
        // $id = $decrypted_id;
        $response['customer'] = Tenant::where('id', $id)->first();
        // dd($response['customer']);
        $response['user'] = User::where('tenant_id', $id)->first();
        // $response['billplan'] = AgentBillplan::select('bill_plan.name', 'bill_plan.type', 'bill_plan.id as bill_plan_id', 'agent_billplan.id as agent_billplan_id', 'agent_billplan.commission')->where('agent_id', $id)->leftjoin('bill_plan', 'bill_plan.id', 'agent_billplan.billplan_id')->where("agent_billplan.status", "ACTIVE")->orderBy('agent_billplan.id', 'desc')->paginate($perpage);
        // $response['billplan_list'] = BillPlan::get();
        // $response['i'] = 1;
        // if ($request->ajax()) {
        //     // dd($id);
        //     $response_part['i'] = $perpage * ($request->page - 1);
        //     if ($request->addnewplan) {
        //         $response_part['inew'] = "addnewplan";
        //         $response_part['i'] = 0;
        //     }

        //     $response_part['page'] = 'agentedit_billing';
        //     $response_part['billplan'] = $response['billplan'];
        //     // dd($id);
        //     $view = view('user.data', $response_part)->render();
        //     $response_ajex['html'] = $view;

        //     return response()->json($response_ajex);
        // }
        return view('tenant.edit', $response);

    }
}
