<?php

namespace App\Http\Controllers;

use App\Imports\DidImport;
use App\Models\Did;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use File;
use Maatwebsite\Excel\Facades\Excel;

class DidsController extends Controller
{
    
    public function dids(Request $request)
    {
        $perpage = 3;
        DB::enableQueryLog();
        $dids = Did::orderBy('id', 'DESC');
        $dids = $dids->leftjoin('vendor','did.vendor_id','vendor.id');
        $dids = $dids->leftjoin('tenant','did.account_number','tenant.account_number');
        $dids = $dids->select('did.*','vendor.vendor_name','tenant.company_name', 'did.id as id');

        $allocatednumber = Did::where('did.status', 'ALLOCATED')->leftjoin('vendor','did.vendor_id','vendor.id')->leftjoin('tenant','did.account_number','tenant.account_number')->select('did.*','vendor.vendor_name','tenant.company_name', 'did.id as id');
        $reservednumber = Did::where('did.status', 'RESERVED')->leftjoin('vendor','did.vendor_id','vendor.id')->leftjoin('tenant','did.account_number','tenant.account_number')->select('did.*','vendor.vendor_name','tenant.company_name', 'did.id as id');
        $availablenumber = Did::where('did.status', 'AVAILABLE')->leftjoin('vendor','did.vendor_id','vendor.id')->leftjoin('tenant','did.account_number','tenant.account_number')->select('did.*','vendor.vendor_name','tenant.company_name', 'did.id as id');

        $vendor = Vendor::all();
        if ($request->ajax()) {
            if ($request->search) {
                $search_key = $request->search;
                $dids->where(function ($dids1) use ($search_key) {
                    $dids1 = $dids1->where('did.number', 'LIKE', "%{$search_key}%")->orWhere('tenant.company_name', 'LIKE', "%{$search_key}%")->orWhere('did.status', 'LIKE', "%{$search_key}%")->orWhere('vendor.vendor_name', 'LIKE', "%{$search_key}%");
                });
                
                $allocatednumber->where(function ($allocatednumber1) use ($search_key) {
                    $allocatednumber1 = $allocatednumber1->where('did.number', 'LIKE', "%{$search_key}%")->orWhere('tenant.company_name', 'LIKE', "%{$search_key}%")->orWhere('did.status', 'LIKE', "%{$search_key}%")->orWhere('vendor.vendor_name', 'LIKE', "%{$search_key}%");
                });

                $reservednumber->where(function ($reservednumber1) use ($search_key) {
                    $reservednumber1 = $reservednumber1->where('did.number', 'LIKE', "%{$search_key}%")->orWhere('tenant.company_name', 'LIKE', "%{$search_key}%")->orWhere('did.status', 'LIKE', "%{$search_key}%")->orWhere('vendor.vendor_name', 'LIKE', "%{$search_key}%");
                });
                $availablenumber->where(function ($availablenumber1) use ($search_key) {
                    $availablenumber1 = $availablenumber1->where('did.number', 'LIKE', "%{$search_key}%")->orWhere('tenant.company_name', 'LIKE', "%{$search_key}%")->orWhere('did.status', 'LIKE', "%{$search_key}%")->orWhere('vendor.vendor_name', 'LIKE', "%{$search_key}%");
                });
            }
        }


        $dids = $dids->paginate($perpage);
        if ($request->ajax()) {        
            $response_ajex['totalrecords'] = $dids->total();
            $response_part['records'] = $dids;
            $response_part['page'] = 'dids';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;            

            $response_ajex['records'] = $response_part['records'];
            $response_ajex['allocatednumber'] = $allocatednumber->count();
            $response_ajex['reservednumber'] = $reservednumber->count();
            $response_ajex['availablenumber'] = $availablenumber->count();    
            return response()->json($response_ajex);
        }


        $response['records'] = $dids;
        $response['vendor'] = $vendor;

        $response['totalrecords'] = $dids->total();
        $response['allocatednumber'] = $allocatednumber->count();
        $response['reservednumber'] = $reservednumber->count();
        $response['availablenumber'] = $availablenumber->count();      
        // dd($response['availablenumber']);       
        return view('did.did', $response);
    }
    public function phone_add_ajex(Request $request){
        $error = 0;
        $validator = Validator::make($request->all(), [
            'vendor' => 'required',
            'number' => 'required|unique:did,number',            
            'rate_center' => 'required'
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }
        $did['vendor_id'] = $request->vendor;
        $did['number'] = $request->number;
        $did['rate_center'] = $request->rate_center;

        try {
            $add_did = Did::create($did);
            if ($add_did && $inserted_id = $add_did->id) {
                return response()->json(["status" => "success", "data" => "Phone Number Added Successfully ".$inserted_id, "error" => $error]);
            }
        }catch(\Exception $e){
            $error = $e->getMessage();
        }
        
        
        return response()->json(["status" => "fail", "data" => "Phone Number Added Fail", "error" => $error]);
        
    }
    public function importinsert(Request $request){
        $error = 0;
        $request->vendor = $request->vendor_import;
        $request->file = $request->number_file;
        $requestarray['vendor'] = $request->vendor_import;
        $requestarray['file'] = $request->file('file');
        $validator = Validator::make($requestarray, [
            'vendor' => 'required',
            'file' => 'required',            
            
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            $data_responce['request'] = $request->all();
            return response()->json($data_responce, 200);
        }

        /* Getting file name */   
        $filename = date('d-m-Y-H-i').$_FILES['file']['name'];

        /* Location */
        $path = "upload";   
        $location = $path.'/'.$filename;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        /* Valid extensions */   
        $valid_extensions = array("csv");

        $response = 0;
       
        /* Upload file */      
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $response = $location;
        }
       
        $response1['vendor'] = $requestarray['vendor'];
        try{
            Excel::import(new DidImport($response1), $response);            
            return response()->json(["status" => "success", "data" => "Phone Number Added Successfully ", "error" => $error]);
           
        }catch(\Exception $e){
            $error = $e->getMessage(); 
        }
        return response()->json(["status" => "fail", "data" => "Phone Number Added Fail", "error" => $error]);
    }
}