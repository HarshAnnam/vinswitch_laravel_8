<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\Agent;
use App\Models\AgentBillplan;
use App\Models\AgentComission;
use App\Models\AgentCommissionPayment;
use App\Models\BillPlan;
use App\Models\User;
use App\Providers\EncreptDecrept;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\URL;
//use Spatie\ArrayToXml\ArrayToXml;
use Tymon\JWTAuth\Facades\JWTAuth;
// use App\Services\EncreptDecrept;

class AgentController extends Controller
{

    function __construct()
    {
        //  $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['agentlist','show']]);
        //  $this->middleware('permission:product-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    // agentlist page
    public function agentlist(Request $request)
    {
        
        $perpage = 4;
        $agent = Agent::orderBy('id', 'DESC');
        $activeagents = Agent::where('status', 'ACTIVE');
        $suspendedagents = Agent::where('suspended', 'YES');
        $response['billplan_list'] = BillPlan::get();
        if ($request->ajax()) {
            if ($request->search) {
                $search_key = $request->search;
                $agent->where(function ($agent1) use ($search_key) {
                    $agent1 = $agent1->where('firstname', 'LIKE', "%{$search_key}%")->orWhere('lastname', 'LIKE', "%{$search_key}%")->orWhere('email', 'LIKE', "%{$search_key}%")->orWhere('company_name', 'LIKE', "%{$search_key}%");
                });
                $activeagents->where(function ($activeagents1) use ($search_key) {
                    $activeagents1 = $activeagents1->where('firstname', 'LIKE', "%{$search_key}%")->orWhere('lastname', 'LIKE', "%{$search_key}%")->orWhere('email', 'LIKE', "%{$search_key}%")->orWhere('company_name', 'LIKE', "%{$search_key}%");
                });
                $suspendedagents->where(function ($suspendedagents1) use ($search_key) {
                    $suspendedagents1 = $suspendedagents1->where('firstname', 'LIKE', "%{$search_key}%")->orWhere('lastname', 'LIKE', "%{$search_key}%")->orWhere('email', 'LIKE', "%{$search_key}%")->orWhere('company_name', 'LIKE', "%{$search_key}%");
                });
            }
        }


        $agent = $agent->paginate($perpage);

        if ($request->ajax()) {
            $response_ajex['totalrecords'] = $agent->total();
            $response_part['records'] = $agent;
            $response_part['page'] = 'agentlist';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;
            $response_ajex['activeagents'] = $activeagents->count();
            $response_ajex['suspendedagents'] = $suspendedagents->count();
            return response()->json($response_ajex);
        }

        $response['records'] = $agent;
        $response['totalrecords'] = $agent->total();
        $response['activeagents'] = $activeagents->count();
        $response['suspendedagents'] = $suspendedagents->count();

        return view('user.agentlist', $response);
    }

    // public function agentlistajax()
    // {
    //     $agent = Agent::orderBy('id', 'DESC')->get();           
    //         foreach($agent as $row){ 
    //             $encrypted_id = EncreptDecrept::encrept($row->id); 
    //             $go_to = '<a href="'.url('').'/agentcomission/'.$encrypted_id.'/"><i class="fas fa-info-circle"></i></a>';  



    //             $comission = '<a title="Agent Commission" class="fa fa-money" href="'.url('').'/agentcomission/'.$encrypted_id.'"><i class="fas fa-money-bill-alt text-success"></i></a>';
    //             $tenent = '<a href="'.url('').'/tenent/admin/'.$encrypted_id.'"><i class="fas fa-users"></i></a>';
    //             //$action = '<b><a href="'.url('').'/agent/edit/'.$row->id.'" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a></b><a href="/agent/password/reset/'.$row->id.'"><i class="mdi mdi-link-variant"></i></a>';

    //             // modify for editable datatabel data
    //             $action = '<b><a  class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a></b><a ><i class="mdi mdi-link-variant"></i></a>';
    //             $status = '<span class="badge bg-soft-danger text-danger status" id="status'.$row->id.'">'.$row->status.'</span>';
    //             if($row->status == 'ACTIVE') $status = '<span class="badge bg-soft-success text-success status" id="status'.$row->id.'">'.$row->status.'</span>';

    //             $suspended = '<a><span class="badge bg-soft-danger text-danger suspended" id="suspended'.$row->id.'">'.$row->suspended.'</span></a>';
    //             if($row->suspended == 'NO') $suspended = '<a><span class="badge bg-soft-success text-success suspended" id="suspended'.$row->id.'">'.$row->suspended.'</span></a>';




    //         $records[] = [
    //             'go_to' => $go_to,
    //             'agent_code' => $row->id,
    //             'fname' => $row->firstname,
    //             'lname' => $row->lastname,
    //             //'name' => $row->firstname.' '.$row->lastname,
    //             'company_name' => $row->company_name,
    //             'email' => $row->email,
    //             'balance' => $row->balance,  
    //             'status' => $status,
    //             'suspended' => $suspended,
    //             'comission' => $comission,
    //             'tenent' => $tenent,  
    //             'action' => $action,
    //             'id' => $encrypted_id     
    //         ];
    //     }

    //     $response['data'] = $records;    
    //     return response()->json($response);      

    // }

    // agentlist page
    public function agentlist_update_ajex(Request $request)
    {
        $id = EncreptDecrept::decrept($request->id);
        if (Agent::where("id", $id)->count() == 0) {
            return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
        }
        $columnindex = $request->columnindex;
        $value = $request->value;

        if ($columnindex == "firstname") {
            $update["firstname"] = $value;
        } else if ($columnindex == "lastname") {
            $update["lastname"] = $value;
        } else if ($columnindex == "company_name") {
            $update["company_name"] = $value;
        } else if ($columnindex == "email") {
            $update["email"] = $value;
        } else if ($columnindex == "status") {
            $update["status"] = ($value == 'ACTIVE') ? 'INACTIVE' : 'ACTIVE';
        } else if ($columnindex == "suspended") {
            $update["suspended"] = ($value == 'YES') ? 'NO' : 'YES';
        }

        try {
            $update["modified_at"] = date('Y-m-d H:i:s');
            $User_Update = Agent::where("id", $id)->update($update);
            if ($User_Update) {
                return response()->json(["status" => "success", "data" => "Update Sucessfully ", "error" => 0]);
            }

            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }

    // agentedit page
    public function agentedit_update_ajex(Request $request)
    {
        // return response()->json($request->all());
        $id = EncreptDecrept::decrept($request->id);
        // $id = $id[0];
        // dd(DB::table($request->table)->where("id", $id)->count());
        $id = $id;
        if (DB::table($request->table)->where("id", $id)->count() == 0) {
            return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
        }


        if ($request->table == "agent") {

            // $data = $request->only('firstname', 'lastname',);        
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|min:3',
                'lastname' => 'required|min:3',
                'contact_no' => 'required|digits:10',
                'address' => 'required|min:5',
                'state' => 'required|min:2',
                'city' => 'required|min:2',
                'postal_code' => 'required|min:5',
                'company_name' => 'required|min:3'
            ]);
            if ($validator->fails()) {
                $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
                return response()->json($data_responce, 200);
            }

            // print_r($request->all());  
            // dd($id);    
            $update["firstname"] = $request->firstname;
            $update["lastname"] = $request->lastname;
            // $update["email"] = $request->email;
            $update["contact_no"] = $request->contact_no;
            $update["address"] = $request->address;
            //$update["country"] = $request->country;
            $update["state"] = $request->state;
            $update["city"] = $request->city;
            $update["postal_code"] = $request->postal_code;
            $update["company_name"] = $request->company_name;
            $update["modified_at"] = date('Y-m-d H:i:s');
            // dd($update);
            $User_Update = Agent::where("id", $id)->update($update);
        } else if ($request->table == "users") {

            $validator = Validator::make($request->all(), [
                'firstname_user' => 'required|min:3',
                'lastname_user' => 'required|min:3',
                'contact_no_user' => 'required|digits:10',
            ]);
            if ($validator->fails()) {
                $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
                return response()->json($data_responce, 200);
            }

            $update["firstname"] = $request->firstname_user;
            $update["lastname"] = $request->lastname_user;
            // $update["email"] = $request->email;
            $update["phoneno"] = $request->contact_no_user;
            $update["updated_at"] = date('Y-m-d H:i:s');
            // dd($id);
            $User_Update = User::where('role', 'AGENT')->where("id", $id)->update($update);
        }
        try {

            if ($User_Update) {
                return response()->json(["status" => "success", "data" => "Update Sucessfully ", "error" => 0]);
            }
            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }

    // agentlist page
    // add new agent model Information tab
    public function agent_add_ajex(Request $request)
    {
        $check = $request->check ? $request->check : '';
        //return response()->json(["status" => "success", "data" => 25, "error" => 0]);
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
        }else{
            if(!empty($check) && $check == 'check'){
                // dd("here2");
                $data_responce = ["status" => "success", "data" => "Validate", "error" => 0];
                return response()->json($data_responce, 200);
            }
            
        }


        $update["account_code"] = "";

        $update["firstname"] = $request->firstname;
        $update["lastname"] = $request->lastname;
        $update["email"] = $request->email;
        $update["contact_no"] = $request->contact_no;
        $update["address"] = $request->address;
        $update["country"] = $request->country;
        $update["state"] = $request->state;
        $update["city"] = $request->city;
        $update["postal_code"] = $request->postal_code;
        $update["company_name"] = $request->company_name;

        try {
            if ($request->id == 0) {
                $update["join_date"] = date("Y-m-d");
                $add_agent = Agent::create($update);

                // $role[] = 'AGENT';
                // $add_agent->assignRole($role);
                if ($inserted_id = $add_agent->id) {
                    return response()->json(["status" => "success", "data" => $inserted_id, "error" => 0]);
                }
            } else {
                $update["modified_at"] = date('Y-m-d H:i:s');
                Agent::where("id", $request->id)->update($update);
                return response()->json(["status" => "success", "data" => "Update Sucessfully", "error" => 0]);
            }


            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }

    // agentlist page
    // add new user model Credential tab
    public function agent_cred_add_ajex(Request $request)
    {
        $check = $request->check ? $request->check : '';
        // dd($request->all());
        // return response()->json(["status" => "success", "data" => 50, "error" => 0]);
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'firstname_user' => 'required|min:3',
            'lastname_user' => 'required|min:3',
            'email_user' => 'required|email',
            'contact_no_user' => 'required|digits:10',
            'password' => 'required|regex:/(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_])/u',
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }else{
            if(!empty($check) && $check == 'check'){
                // dd("here");
                $data_responce = ["status" => "success", "data" => "Validate", "error" => 0];
                return response()->json($data_responce, 200);
            }
        }
        $update["username"] = $request->firstname_user;
        // $update["tenant_id"] = $request->agent_id;
        $update["tenant_id"] = $request->agent_id_qstring;
        $update["password"] = Hash::make($request->password);
        $update["firstname"] = $request->firstname_user;
        $update["name"] = $request->firstname_user;
        $update["lastname"] = $request->lastname_user;
        $update["email"] = $request->email_user;
        $update["phoneno"] = $request->contact_no_user;
        // $update["role"] = 'ADMIN';
        $update["role"] = 'AGENT';
        $update["superuser"] = 1;
        $update["status"] = 'ENABLED';
        // dd($update);
        // DB::enableQueryLog();
        try {
            if ($request->id == 0) {
                $update["create_at"] = date("Y-m-d H:i:s");
                $update["created_at"] = date("Y-m-d H:i:s");
                $add_user = User::create($update);
                // dd(\DB::getQueryLog());
                if ($inserted_id = $add_user->id) {
                    return response()->json(["status" => "success", "data" => $inserted_id, "error" => 0]);
                }
            } else {
                $update["updated_at"] = date('Y-m-d H:i:s');
                $user = User::where("id", $request->id)->update($update);
                //dd($user);
                // dd(\DB::getQueryLog());
                return response()->json(["status" => "success", "data" => "Update Sucessfully", "error" => 0]);
            }


            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }
    // agentlist page
    // add new user model billplan tab
    public function agent_bill_plan_add_ajex(Request $request)
    {
        // dd($request->all());
        // return response()->json(["status" => "success", "data" => 50, "error" => 0]);
        $flag = 0;
        $validator = Validator::make($request->all(), [
            'agent_id' => 'required',
            'billplan_id' => 'required|array',
            'billplan_id.*' => 'required',
            'commission' => 'required|array',
            'commission.*' => 'required',

        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }
        $insert['agent_id'] = $request->agent_id;
        $billplan_ids = $request->billplan_id;
        $commission = $request->commission;
        // foreach($billplan_ids as $key => $value){





        try {
            foreach ($billplan_ids as $key => $value) {
                $insert['billplan_id'] = $value;
                $insert['commission'] = $commission[$key];
                $AgentBillplan = AgentBillplan::create($insert);
                if (!$AgentBillplan) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                return response()->json(["status" => "success", "data" => "Added Successfully", "error" => 0]);
            }
            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => $e->getMessage()]);
        }
    }

    public function agentcomission($id, Request $request)
    {
        // dd("here");
        // return view('user.agentcomission');
        $perpage = 2;
        $response['comissions_total_amount'] = 0;
        $decrypted_id = EncreptDecrept::decrept($id);


        // dd($decrypted_id);

        $comissions = AgentComission::orderBy('id', 'DESC');
        $comissions = $comissions->where('agent_id', $decrypted_id);

        $comissions_total_amount = AgentComission::orderBy('id', 'DESC')->where('agent_id', $decrypted_id);

        if ($request->ajax()) {
            if ($request->search) {
                $search_key = $request->search;
                $comissions->where(function ($comissions1) use ($search_key) {
                    $comissions1 = $comissions1->where('summary', 'LIKE', "%{$search_key}%")->orWhere('amount', 'LIKE', "%{$search_key}%")->orWhere('commission_percentage', 'LIKE', "%{$search_key}%")->orWhere('debit', 'LIKE', "%{$search_key}%")->orWhere('credit', 'LIKE', "%{$search_key}%")->orWhere('balance', 'LIKE', "%{$search_key}%")->orWhere('debit', 'LIKE', "%{$search_key}%");
                });
                $comissions_total_amount->where(function ($comissions_total_amount1) use ($search_key) {
                    $comissions_total_amount1 = $$comissions_total_amount1->where('summary', 'LIKE', "%{$search_key}%")->orWhere('amount', 'LIKE', "%{$search_key}%")->orWhere('commission_percentage', 'LIKE', "%{$search_key}%")->orWhere('debit', 'LIKE', "%{$search_key}%")->orWhere('credit', 'LIKE', "%{$search_key}%")->orWhere('balance', 'LIKE', "%{$search_key}%")->orWhere('debit', 'LIKE', "%{$search_key}%");
                });
            }
            $fromdate = $request->get('fromdate') ? $request->get('fromdate') : '';
            $todate = $request->get('todate') ? $request->get('todate') : '';
            
            if (!empty($fromdate) && empty($todate)) {
                $comissions = $comissions->whereDate('created_date',$fromdate); 
                $comissions_total_amount = $comissions_total_amount->whereDate('created_date',$fromdate);              
            } else {
                if (!empty($fromdate)) {
                    $comissions = $comissions->whereDate('created_date', '>=', $fromdate);
                    $comissions_total_amount = $comissions_total_amount->whereDate('created_date', '>=', $fromdate);
                   
                }
                if (!empty($todate)) {
                    $comissions = $comissions->whereDate('created_date', '<=', $todate);
                    $comissions_total_amount = $comissions_total_amount->whereDate('created_date', '<=', $todate);
                    
                }
            }
        }


        $comissions = $comissions->paginate($perpage);
        $comissions_total_amount =  $comissions_total_amount->first();
        if ($comissions_total_amount) {
            // dd($comissions_total_amount);
            $response['comissions_total_amount'] = $comissions_total_amount->balance;
            
            $response_ajex['comissions_total_amount'] = $comissions_total_amount->balance;
        }

        if ($request->ajax()) {
            $response_ajex['totalrecords'] = $comissions->total();
            $response_part['records'] = $comissions;
            $response_part['page'] = 'comissions';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;
           // dd($response_ajex['comissions_total_amount']);
            return response()->json($response_ajex);
        }

        $response['records'] = $comissions;
        $response['totalrecords'] = $comissions->total();


        return view('user.agentcomission', $response);
    }
    public function agentcomissionajax($id, Request $request)
    {
        $decrypted_id = EncreptDecrept::decrept($id);
        $agent_comission_list = AgentComission::where('agent_id', $decrypted_id);
        $fromdate = $request->get('fromdate') ? $request->get('fromdate') : '';
        $todate = $request->get('todate') ? $request->get('todate') : '';
        // $fromdate = '2021-10-13';
        // $todate = '2021-10-13';
        if (!empty($fromdate)) {
            $agent_comission_list = $agent_comission_list->whereDate('created_date', '>=', $fromdate);
            // $agent_comission_list = $agent_comission_list->where('created_date', '>=', $fromdate);
        }
        if (!empty($todate)) {
            $agent_comission_list = $agent_comission_list->whereDate('created_date', '<=', $todate);
            // $agent_comission_list = $agent_comission_list->where('created_date', '>=', $fromdate);
        }

        $agent_comission_list = $agent_comission_list->get();
        //dd($agent_comission_list);
        foreach ($agent_comission_list as $data) {
            $date = new DateTime($data->created_date);

            // $date_result = $date->format('Y-M-d H:i');
            $date_result = $date->format(Config('const.datepicker-format1'));
            $records[] = [
                'summary' => $data->summary,
                'amount' => $data->amount,
                'commission' => $data->commission_percentage,
                'debit' => $data->debit,
                'cradit' => $data->cradit,
                'balance' => $data->balance,
                'created' => $date_result,
                'tenant' => $data->tenant_account_number,
                'id' =>   $id,
            ];
        }


        $response['data'] = $records;
        return response()->json($response);
    }

    // agentedit page 
    public function agentedit($id, Request $request)
    {
        $perpage = 3;
        $decrypted_id = EncreptDecrept::decrept($id);

        if (Agent::where("id", $decrypted_id)->count() == 0) {
            return redirect('/agentlist');
        }
        // dd($id);

        // $id = $decrypted_id[0];
        $id = $decrypted_id;
        $response['agent'] = Agent::where('id', $id)->first();
        // dd($id);
        // dd($response['agent']);
        $response['user'] = User::where('tenant_id', $id)->first();
        $response['billplan'] = AgentBillplan::select('bill_plan.name', 'bill_plan.type', 'bill_plan.id as bill_plan_id', 'agent_billplan.id as agent_billplan_id', 'agent_billplan.commission')->where('agent_id', $id)->leftjoin('bill_plan', 'bill_plan.id', 'agent_billplan.billplan_id')->where("agent_billplan.status", "ACTIVE")->orderBy('agent_billplan.id', 'desc')->paginate($perpage);
        $response['billplan_list'] = BillPlan::get();
        $response['i'] = 1;
        if ($request->ajax()) {
            // dd($id);
            $response_part['i'] = $perpage * ($request->page - 1);
            if ($request->addnewplan) {
                $response_part['inew'] = "addnewplan";
                $response_part['i'] = 0;
            }

            $response_part['page'] = 'agentedit_billing';
            $response_part['billplan'] = $response['billplan'];
            // dd($id);
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;

            return response()->json($response_ajex);
        }
        return view('user.agentedit', $response);
    }
    // agentedit page ajex update bill plan comission
    public function agenteditbillplan_update_ajex(Request $request)
    {
        $id = EncreptDecrept::decrept($request->id);
        $columnindex = $request->columnindex;
        $value = $request->value;


        $update[$columnindex] = $value;


        try {
            if (AgentBillplan::where("id", $id)->count() == 0) {
                return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
            }
            $User_Update = AgentBillplan::where("id", $id)->update($update);
            if ($User_Update) {
                return response()->json(["status" => "success", "data" => "Update Sucessfully ", "error" => 0]);
            }
            return response()->json(["status" => "success", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
    }

    // agentedit page add new bill plan 
    public function addbillplan_ajex(Request $request)
    {
        $id = EncreptDecrept::decrept($request->id);
        $data = $request->only('billplan_id', 'commission');
        $validator = Validator::make($data, [
            'billplan_id' => 'required',
            'commission' => 'required|digits_between:1,3',
        ]);
        // dd($request->all());
        //Send failed response if request is not valid

        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }
        // dd($id);
        $status = 'ACTIVE';
        $newplan = new AgentBillplan();
        // $newplan->agent_id = $id[0];
        $newplan->agent_id = $id;
        $newplan->billplan_id = $request->billplan_id;
        $newplan->commission = (int)$request->commission;
        $newplan->status = $status;
        if ($newplan->save()) {
            return response()->json(["status" => "success", "data" => "Update Sucessfully ", "error" => 0]);
        }
        return response()->json(["status" => "danger", "data" => "Somthing Wrong ", "error" => 0]);
    }

    // public function deleteData($id, $table, Request $request)
    // {
    //     $id = EncreptDecrept::decrept($id);
    //     $flag = 0;

    //     $data['id'] = $id;
    //     $data['table'] = $table;

    //     if (DB::table($data['table'])->where("id", $id)->count() == 0) {
    //         return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
    //     }

    //     if ($data['table'] == "agent_billplan") {
    //         $update['status'] = 'INACTIVE';
    //         $flag = 1;
    //     }
    //     if ($flag == 0) {
    //         $update['delete'] = '1';
    //     }

    //     try {
    //         $User_Update = DB::table($data['table'])->where('id', $data['id'])->update($update);

    //         if ($User_Update) {
    //             return response()->json(["status" => "success", "data" => "Record deleted sucessfully " . $User_Update, "error" => 0]);
    //         }
    //         return response()->json(["status" => "fail", "data" => "Somthing Wrong!", "error" => 0]);
    //     } catch (\Exception $e) {
    //         return response()->json(["status" => "fail", "data" => "Somthing Wrong!", "error" => $e->getMessage()]);
    //     }
    // }

    public function deleteData($id, $table, Request $request)
    {
        // dd("Hi");
        $id = EncreptDecrept::decrept($id);
        
        $data['id'] = $id;
        $data['table'] = $table;

        if (DB::table($data['table'])->where("id", $id)->count() == 0) {
            return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
        }

        try {
            $User_delete = DB::table($data['table'])->where('id', $data['id'])->delete();

            if ($User_delete) {
                return response()->json(["status" => "success", "data" => "Record deleted sucessfully " . $User_delete, "error" => 0]);
            }
            return response()->json(["status" => "fail", "data" => "Somthing Wrong!", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Somthing Wrong!", "error" => $e->getMessage()]);
        }

    }




    // make payment submit
    // agent list -> agentcomission -> make payment
    public function make_payment_submit(Request $request){

        $validator = Validator::make($request->all(), [
            'payment_date' => 'required',
            'amount' => 'required|numeric|between:0,9999999999.99',
            'payment_method' => 'required',            
            'reference_number' => 'required'
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }
        $insert['agent_id'] = $request->agent_id;
        $insert['payment_date'] = $request->payment_date;
        $insert['amount'] = $request->amount;
        $insert['payment_method'] = $request->payment_method;
        $insert['reference_number'] = $request->reference_number;
        try {
            $AgentCommissionPayment = AgentCommissionPayment::create($insert);
            if ($AgentCommissionPayment) {
                return response()->json(["status" => "success", "data" => "Added Successfully", "error" => 0]);
            }
            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => $e->getMessage()]);
        }

    }
}
