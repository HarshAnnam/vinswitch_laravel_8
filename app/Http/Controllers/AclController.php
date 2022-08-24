<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Acl;
use App\Models\Acllists;
use App\Providers\EncreptDecrept;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Message\RequestFactoryInterface;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class AclController extends Controller
{
    public function acl(Request $request)
    {
        $perpage = 3;
        DB::enableQueryLog();
        // $acl = Acl::all();
        $acl = Acl::orderBy('id', 'DESC');
        $acl = $acl->leftjoin('acl_lists', 'acl_nodes.list_id', 'acl_lists.id');
        $acl = $acl->select('acl_nodes.*', 'acl_lists.acl_name', 'acl_nodes.id as id');
        $acl = $acl->Where('delete', "0");
        $acltypeallow = Acl::where('type', 'allow')->Where('delete', "0");
        $acltypeallow = $acltypeallow->leftjoin('acl_lists','acl_nodes.list_id','acl_lists.id');
        $acltypeallow = $acltypeallow->select('acl_nodes.*', 'acl_lists.acl_name', 'acl_nodes.id as id');
        $acltypedeny = Acl::where('type','deny')->Where('delete', "0");
        $acltypedeny = $acltypedeny->leftjoin('acl_lists','acl_nodes.list_id','acl_lists.id');
        $acltypedeny = $acltypedeny->select('acl_nodes.*', 'acl_lists.acl_name', 'acl_nodes.id as id');

        $acllist = Acllists::all();
        if ($request->ajax()) {
            if ($request->search) {
                $search_key = $request->search;
                $acl->where(function ($acl1) use ($search_key) {
                    $acl1 = $acl1->where('acl_nodes.cidr', 'LIKE', "%{$search_key}%")->orWhere('acl_lists.acl_name', 'LIKE', "%{$search_key}%")->orWhere('acl_nodes.type', 'LIKE', "%{$search_key}%");
                });

                $acltypeallow->where(function ($acltypeallow1) use ($search_key) {
                    $acltypeallow1 = $acltypeallow1->where('acl_nodes.cidr', 'LIKE', "%{$search_key}%")->orWhere('acl_lists.acl_name', 'LIKE', "%{$search_key}%")->orWhere('acl_nodes.type', 'LIKE', "%{$search_key}%");
                });
                
                $acltypedeny->where(function ($acltypedeny1) use ($search_key) {
                    $acltypedeny1 = $acltypedeny1->where('acl_nodes.cidr', 'LIKE', "%{$search_key}%")->orWhere('acl_lists.acl_name', 'LIKE', "%{$search_key}%")->orWhere('acl_nodes.type', 'LIKE', "%{$search_key}%");
                });

            }
        }

        $acl = $acl->paginate($perpage);
        if ($request->ajax()) {
            $response_ajex['totalrecords'] = $acl->total();
           
            $response_part['records'] = $acl;
            $response_part['page'] = 'acl';
            $view = view('user.data', $response_part)->render();
            $response_ajex['html'] = $view;

            $response_ajex['records'] = $response_part['records'];
            $response_ajex['acltypeallow'] = $acltypeallow->count();
            $response_ajex['acltypedeny'] = $acltypedeny->count();
            return response()->json($response_ajex);
        }

        $response['records'] = $acl;
        // $response['vendor'] = $vendor; 
        $response['totalrecords'] = $acl->total();
        // dd($response);
        $response['acltypeallow'] = $acltypeallow->count();
        $response['acltypedeny'] = $acltypedeny->count();
        $response['acllist'] = $acllist;
        return view('acl.index', $response);
    }



    public function acl_update_ajex(Request $request)
    {
        // dd($request->all());
        $id = EncreptDecrept::decrept($request->id);
        // dd(Acl::where("id", $id)->count());
        if (Acl::where("id", $id)->count() == 0) {
            return response()->json(["status" => "fail", "data" => "Record not exist", "error" => 0]);
        }
        $columnindex = $request->columnindex;
        $value = $request->value;

        if ($columnindex == "cidr") {
            $update["cidr"] = $value;
        }else if($columnindex == "type") {
            $update["type"] = ($value == 'allow') ? 'deny' : 'allow';
        }else if($columnindex == "list_id"){
            $update["list_id"] = $value;
        }
        try {
            //   echo $id;
            //   dd($update);
            $User_Update = Acl::where("id", $id)->update($update);
            // dd($User_Update);
            if ($User_Update) {
                return response()->json(["status" => "success", "data" => "Update Sucessfully ", "error" => 0]);
            }

            return response()->json(["status" => "fail", "data" => "Something wrong", "error" => 0]);
        } catch (\Exception $e) {
            return response()->json(["status" => "fail", "data" => "Record not found", "error" => $e->getMessage()]);
        }
        
    }

    public function acl_add_ajex(Request $request){
        $error = 0;
        $validator = Validator::make($request->all(), [
            'cidr' => 'required',
            'type' => 'required',            
            'list' => 'required',
            'is_endpoint' => 'required'
        ]);
        if ($validator->fails()) {
            $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
            return response()->json($data_responce, 200);
        }
        $cidr['cidr'] = $request->cidr;
        $cidr['type'] = $request->type;
        $cidr['list_id'] = $request->list;
        $cidr['is_endpoint'] = $request->is_endpoint;

        try {
            $add_acl = Acl::create($cidr);
            if ($add_acl && $inserted_id = $add_acl->id) {
                return response()->json(["status" => "success", "data" => "Acl Added Successfully ".$inserted_id, "error" => $error]);
            }
        }catch(\Exception $e){
            $error = $e->getMessage();
        }


        return response()->json(["status" => "fail", "data" => "Acl Added Fail", "error" => $error]);
}


}
    






    

    // }
    // public function importinsert(Request $request){
    //     $error = 0;
    //     $request->vendor = $request->vendor_import;
    //     $request->file = $request->number_file;
    //     $requestarray['vendor'] = $request->vendor_import;
    //     $requestarray['file'] = $request->file('file');
    //     $validator = Validator::make($requestarray, [
    //         'vendor' => 'required',
    //         'file' => 'required',            

    //     ]);
    //     if ($validator->fails()) {
    //         $data_responce = ["status" => "danger", "data" => "Validation error", "error" => $validator->messages()];
    //         $data_responce['request'] = $request->all();
    //         return response()->json($data_responce, 200);
    //     }

    //     /* Getting file name */   
    //     $filename = date('d-m-Y-H-i').$_FILES['file']['name'];

    //     /* Location */
    //     $path = "upload";   
    //     $location = $path.'/'.$filename;
    //     $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    //     $imageFileType = strtolower($imageFileType);

    //     if (!file_exists($path)) {
    //         mkdir($path, 0777, true);
    //     }
    //     /* Valid extensions */   
    //     $valid_extensions = array("csv");

    //     $response = 0;

    //     /* Upload file */      
    //     if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    //         $response = $location;
    //     }

    //     $response1['vendor'] = $requestarray['vendor'];
    //     try{
    //         Excel::import(new DidImport($response1), $response);            
    //         return response()->json(["status" => "success", "data" => "Phone Number Added Successfully ", "error" => $error]);

    //     }catch(\Exception $e){
    //         $error = $e->getMessage(); 
    //     }
    //     return response()->json(["status" => "fail", "data" => "Phone Number Added Fail", "error" => $error]);
    // }
