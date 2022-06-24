<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\role;
use App\Models\ActiveUser;
use Validator;

class AuthController extends Controller
{

 /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [interger] method_login
     * @param  [string] uid
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */

    public function tokenuser(Request $request ,$email,$password, $uid){
        if (!Auth::attempt(['email' => $email, 'password' => $password, 'uid' => $uid]))
             return response()->json([
                'message' => 'Unauthorized'
                ], 401);
            $user = $request->user();
            
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'user' => auth()->user(),
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
    } 


    public function socialnetwoking(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string',
            'method_login' => 'required'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $login_method_id = $request->input('login_method_id');
        $uid = $request->input('uid');

        $check_uid = User::where([
            'uid' => $uid,
        ])->first();
   
        if($check_uid){
            if($check_uid->email !== $request->email){

                $change =  User::find($check_uid->id)->update(['email' => $request->email]);
              return $this->tokenuser($request ,$email,$password,$uid);

            }  else{
                return $this->tokenuser($request ,$email,$password, $uid);                
            }
        }else{
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'uid' => $uid,
                'password' => bcrypt("000000"),
                'avatar' => $request->avatar,
                'phone' => null,
                'gender' => null,
                'birthday' => null,
                'status' => 1,
                'login_method_id' => $request->method_login,
            ]);
            $user->save();
    
            if ($user) {
                $TNew_role = new role();
    
                $TNew_role->user_id = $user->id;
                $TNew_role->role_id = 2;
                $TNew_role->name = "customer";
                $TNew_role->status = 1;
    
                $TNew_role->save();
            }
            return $this->tokenuser($request, $email, $password, $uid);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'uid' => '',
            'password' => bcrypt($request->password),
            'avatar' => $request->avatar,
            'phone' => null,
            'gender' => null,
            'birthday' => null,
            'status' => 1,
            'login_method_id' => 1,
        ]);
        $user->save();

        if ($user) {
            $TNew_role = new role();

            $TNew_role->user_id = $user->id;
            $TNew_role->role_id = 2;
            $TNew_role->name = "customer";
            $TNew_role->status = 1;

            $TNew_role->save();
        }
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function ActiveUser(Request $request)
    {
        $type = $request->input('type');;
        $code_active = $request->input('code_active');
        $email = $request->input('email');

        if ($code_active) {
            $check = ActiveUser::where([
                'email' => $email,
                'code' => $code_active,
            ])->first();

            $dateNow = Carbon::now();

            if ($check) {
                $dateCheck = Carbon::parse($check->created_at)->addHour();

                if ($dateCheck >= $dateNow) {
                    $check->delete();
                    return response()->json(['message' => 'success']);
                } else {
                    return response()->json(['message' => 'error']);
                }
            } else {
                return response()->json(['message' => 'error']);
            }
        } else {
           if($type == "forgot"){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
           }else{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
            ]);
           }
            if ($validator->fails()) {
                return response()->json(['message' => 'error', 'errors' => $validator->errors()]);
            } else {
                $delete_active = ActiveUser::where('email', $email)->delete();

                $TNew_Active = new ActiveUser();

                $code = rand(10000, 99999);

                $TNew_Active->email = $email;
                $TNew_Active->code = $code;

                $TNew_Active->save();

                Mail::send('auth.email.mailfb', [
                    'email' => $TNew_Active->email,
                    'code' => $TNew_Active->code,
                ], function ($message) use ($TNew_Active) {
                    $message->to($TNew_Active->email, 'User register')->subject('Code active user.');
                });

                return response()->json(['message' => 'success']);
            }
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
       
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
            'method_login'=> 'required',
        ]);
        if($request->method_login == 1){
            $credentials = request(['email', 'password']);
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'login_method_id' => 1]))
                {
                    return response()->json([
                        'message' => 'Unauthorized'
                    ], 401);
                }
            $user = $request->user();
    
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            return response()->json([
                'user' => auth()->user(),
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }else{
            return response()->json(["message" => "method_login require = 1"] );
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function forgotpassword(Request $request){
        $email = $request->input('email');
        $new_password = $request->input('new_password');
        $user = User::where('email', $email)->first();
        if($user){
           
            $change =  User::find($user->id)->update(['password' => Hash::make($new_password)]);
            return response()->json(['message' => 'success']);
        }
        return response()->json(['message' => 'not found user']);
    }
}