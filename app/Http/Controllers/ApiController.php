<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
//use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Mail;
use App\Mail\QRmail;

use JWTAuth;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password', 'sipusername', 'sippassword', 'sipdomainname', 'status');
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'sipusername' => 'required',
            'sippassword' => 'required|min:6|max:50',
            'sipdomainname' => 'required',
        ]);

        //Send failed response if request is not valid

        if ($validator->fails()) {
            $data_responce = ['error' => $validator->messages()];
            return response()->json($data_responce, 200);
        }


        //Request is valid, create new user

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => bcrypt($request->password)
            'password' => Hash::make($request->password),
            'sipusername' => $request->sipusername,
            'sippassword' => $request->sippassword,
            'sipdomainname' => $request->sipdomainname,
            'status' => $request->status

        ]);

        /* start QR code generation */

        $body = 'csc:' . $request->name . ':' . $request->password . '@REMIPBX*';
        $qr = \QrCode::format('png')->size(200)->generate($body);
        Mail::send(
            'EMail.QRemail',
            [
                'title' => 'Remipbx user QR code authentication',
                'qr' => $qr
            ],
            function ($message) use ($request) {
                $message->to($request->email, $request->name)
                    ->subject('Login Credentials')
                    ->from('devvindaloovoip@gmail.com', 'Remipbx Authentication');
            }
        );
        return "send";

        /* QR code */
        //User created, return success response

        $data_responce = [
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ];

        return response()->xml($data_responce);
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $user_data = User::where('name', $request->cloud_username)->first();
        //  $request->email = $user_data->email;
        //dd($request->all());
        if (!$user_data) {
            $data_responce = [
                'success' => false,
                'message' => 'Login credentials are invalid.',
            ];
            //return response()->json($data_responce, 400);
            return response()->xml($data_responce);
        }

        $credentials['cloud_username'] = $user_data->email;
        $credentials['cloud_password'] = $request->cloud_password;
        // $credentials = $request->only('email', 'password');
        //$credentials = $request->only('email', 'password');
        //dd($credentials);
        //valid credential

        $validator = Validator::make($credentials, [
            // 'email' => 'required|email',
            'cloud_username' => 'required',
            'cloud_password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid


        if ($validator->fails()) {
            $data_responce = ['error' => $validator->messages()];
            //return response()->json($user, 200);

            return response()->xml($data_responce);
        }

        //Request is validated
        //Crean token
        $credentials1['email'] = $user_data->email;
        $credentials1['password'] = $request->cloud_password;
        // dd($credentials1);
        try {
            if (!$token = JWTAuth::attempt($credentials1)) {
                $data_responce = [
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ];
                //return response()->json($data_responce, 400);

                return response()->xml($data_responce);
            }
        } catch (JWTException $e) {

            //return $credentials;

            //return response()->json([ 'success' => false, 'message' => 'Could not create token.', ], 500);

            $data_responce = [
                'success' => false,
                'message' => 'Could not create token.',
            ];
            //return response()->json($data_responce, 400);

            return response()->xml($data_responce);
        }

        //Token created, return with success response and jwt token
        //return response()->json([ 'success' => true, 'token' => $token]);
        //return response()->json(['user' => $data_responce]);

        $user_data = User::where('email', $credentials1['email'])->first();

        $data_responce['token'] = $token;
        // $data_responce['account']['cloud_username'] = $user_data['name'];
        // $data_responce['account']['cloud_password'] = $request->cloud_password;
        $data_responce['account']['username'] = $user_data['sipusername'];
        $data_responce['account']['password'] = $user_data['sippassword'];
        //$data_responce['account']['cloud_id'] = "REMIPBX";
        //$data_responce['account']['Screen'] = 1;
        $data_responce['account']['host'] = $user_data['sipdomainname'];
        $data_responce['email'] = $user_data['email'];
        $data_responce['success'] = true;
        // $data_responce['success1'] = "fdg gs ";
        // $data_responce1 = \QrCode::size(500)
        //     ->format('png')
        //     ->generate('ItSolutionStuff.com', public_path('qr/qrcode.png'));
        //  $data_responce1 = \QrCode::size(300)->merge('qr/qrcode.png', 0.5, true)
        //              ->backgroundColor(255,55,0)
        //              ->generate('A simple example of QR code');
        $time = time();
        //$explode = implode("|",$data_responce);
        //dd($explode);
        //\QrCode::generate($data_responce, 'qr/'.$time.'.svg');

        //$img_url = 'qr/'.$time.'.svg';
        // $data_responce1 = $data_responce;
        //return response()->xml($img_url);      
        //$result = ArrayToXml::convert($data_responce['account'], ['rootElementName' => 'account'], true, 'UTF-8', '1.1', [], true); 
        //dd($result);
        // return response()->xml($data_responce['account']);
        // return response()->xml($data_responce);

        if ($user_data->status == 0) {
            $user_data->status = 1;
            $user_data->update();
            return response()->xml($data_responce['account']);
        } else {
            $data_responce = [
                'success' => false,
                'message' => 'unauthorized'
            ];
            return response()->xml($data_responce, 400);
        }
    }


    public function logout(Request $request)
    {
        //valid credential

        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid

        if ($validator->fails()) {
            $data_responce = ['error' => $validator->messages()];
            //return response()->json($data_responce, 200);

            return response()->xml($data_responce);
        }

        //Request is validated, do logout 

        try {
            JWTAuth::invalidate($request->token);
            $data_responce = [
                'success' => true,
                'message' => 'User has been logged out'
            ];
            //return response()->json($data_responce);

            return response()->xml($data_responce);
        } catch (JWTException $exception) {
            $data_responce = [
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ];
            //return response()->json($data_responce, Response::HTTP_INTERNAL_SERVER_ERROR);

            return response()->xml($data_responce);
        }
    }

    public function get_user(Request $request)
    {
        //return response()->json(["token" => $request->token,"type"=>gettype($request->token)]);

        $this->validate($request, [
            'token' => 'required'
        ]);

        $data_responce = JWTAuth::authenticate($request->token);

        //return response()->json(['user' => $data_responce]);

        return response()->xml($data_responce);
    }
    public function createLoginlink($id = 5)
    {

        $user_data = User::find($id);
        $domain = "http://192.168.1.118/api/login/?";
        // $domain = "http://192.168.1.118/prov/?";
        // $link = "https//example.com/prov/?cloud_username=johndeo&cloud_password=123456789&cloud_id=REMIPBX&initialScreen=1";
        //$link = $domain."name=".$user_data->name."&password=123456789&cloud_id=REMIPBX&initialScreen=1";
        //  $link = $domain."cloud_username=".$user_data->name."&cloud_password=".$user_data->password."&cloud_id=REMIPBX&initialScreen=1";
        $link = $domain . "cloud_username=" . $user_data->name . "&cloud_password=123456789&cloud_id=REMIPBX&initialScreen=1";
        dd($link);
    }
}
