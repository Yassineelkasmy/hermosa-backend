<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetMail;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request )
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'device_name' => 'required'
        ]);

        $user =User::where('email',$request->email)->first();
        if(($user!=null && $user->email_verified_at==null)|| $user==null){
            if($user!=null) {
                $user->delete();
            }
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);



            $verificationCode = substr(str_shuffle("0123456789"), 0, 6);

            DB::table('unverified_users')->updateOrInsert([
                'email'=>$request->email,
            ],['token'=>$verificationCode,'created_at'=>now()]);


            Mail::to($request->email)->send(new VerifyMail($verificationCode));
            //$token = $user->createToken(request('device_name'))->plainTextToken;
            return response([
                'message'=>'user_created'
            ]);

    }else {
        return response([
            'message'=>'email_already_in_use'
        ]);
    }
}


    public function login(Request $request)

    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
              $response = ["message" => "invalid_email_and_password_combination"];
            return response($response);
        }
        if($user->email_verified_at==null){

            $response = ["message" => "email_unverified"];
            return response($response);


        }
        $user->tokens()->delete();
        $userToken = $user->createToken($request->device_name)->plainTextToken;
        return response(['message'=>'authenticated','user'=>$user,'token'=>$userToken]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = ['message' => 'logged_out'];
        return response($response, 200);
    }

    public function verify(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'code'=>'required|min:6|max:6',
        ]);

        $user = User::where('email' , $request->email)->first();
        if($user==null){
            $response = ['message' => 'email_does_not_exist'];
            return response($response, 200);
        }
        if($user->email_verified_at!=null){
            $response = ['message' => 'already_verified'];
            return response($response,200);
        }

        $code=DB::table('unverified_users')->where('email',$request->email)->first()->token;
        if($code==$request->code) {
            $user->email_verified_at=now();
            $user->save();
            $response = ['message' => 'email_verified'];
            return response($response, 200);
        }else {
            $response = ['message' => 'invalid_code'];
            return response($response, 200);
        }



    }

    public function forgot(Request $request) {
        $request->validate([
            'email'=>'required|email',
        ]);

        if(User::where('email',$request->email)->doesntExist()){

            return response(['message'=>'email_not_found']);
        }
        $verificationCode  = substr(str_shuffle("0123456789"), 0, 6);
        DB::table('password_resets')->updateOrInsert([
            'email'=>$request->email,
        ],['token'=>$verificationCode,'created_at'=>now()]);

        Mail::to($request->email)->send(new ResetMail($verificationCode));

        return response([
            'message'=>'verification_sent'
        ],200);


    }
    public function reset(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'code' => 'required|min:6',
        ]);


        $record = DB::table('password_resets')->where('email',$request->email)->first();
        if($record==null) {
            $response = ['message'=>'request_reset_first'];
            return response($response,200);
        }

        if($record->token == $request->code) {
            $user = User::where('email',$request->email)->first();
            $user->password = bcrypt($request->password);
            $user->email_verified_at=now();
            $user->save();
            DB::table('password_resets')->where('email',$request->email)->delete();
            $response = ['message'=>'password_updated'];
            return response($response,200);

        }else {
            $response = ['message'=>'invalid_code'];
            return response($response,200);
        }



    }
    public function resendConfirmationVerifcation(Request $request) {
        $request->validate([
            'email' => 'required|email',

        ]);

        $user =User::where('email',$request->email)->first();
        if(($user!=null && $user->email_verified_at==null)){



            $verificationCode = substr(str_shuffle("0123456789"), 0, 6);

            DB::table('unverified_users')->updateOrInsert([
                'email'=>$request->email,
            ],['token'=>$verificationCode,'created_at'=>now()]);


            Mail::to($request->email)->send(new VerifyMail($verificationCode));
            return response([
                'message'=>'verification_sent'
            ]);

    }
    else {
        return response([
            'message'=>'unexpected_error'
        ]);
    }


}

    public function resendResetVerifcation(Request $request) {
        $request->validate([
            'email'=>'required|email',
        ]);

        if(User::where('email',$request->email)->doesntExist()){

            return response(['message'=>'unexpected_error']);
        }
        $verificationCode  = substr(str_shuffle("0123456789"), 0, 6);
        DB::table('password_resets')->updateOrInsert([
            'email'=>$request->email,
        ],['token'=>$verificationCode,'created_at'=>now()]);

        Mail::to($request->email)->send(new ResetMail($verificationCode));

        return response([
            'message'=>'verification_sent'
        ],200);
    }
    public function user(Request $request)
    {
        return response(['message'=>'authenticated','user'=>$request->user()]);
    }
}
