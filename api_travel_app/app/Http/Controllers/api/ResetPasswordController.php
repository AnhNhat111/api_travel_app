<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ActiveUser;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Validator;

class ResetPasswordController extends Controller
{
    // public function CheckEmail(Request $request)
    // {
    //     $email = $request->input('email');

    //     $check_user = User::where('email', $email)
    //         ->first();

    //     if ($check_user) {
    //         return response()->json([
    //             'message' => 'success',
    //             'user_id' => $check_user->id,
    //         ]);

    //     } else {
    //         return response()->json(['message' => 'error']);
    //     }
    // }

    public function changeInformation(Request $request)
    {
        $type = $request->input("type");
        if ($type === 1) {
            $TUpdate = User::find(Auth::user()->id);

            $TUpdate->name = $request->input('name', $TUpdate->name);
            $TUpdate->avatar = $request->input('avatar', $TUpdate->avatar);
            $TUpdate->gender = $request->input('gender', $TUpdate->gender);
            $TUpdate->birthday = $request->input('birthday', $TUpdate->birthday);
            return response()->json($TUpdate);
        }
        // $change_infor =  User::find(auth()->user()->id)->update([
        //     'name'=> $name,
        //     'avatar'=> $avatar,
        //     'gender'=> $gender,Auth::user()->gender,
        //     'birthday'=> $birthday
        // ]);
        return response()->json(['message' => 'no change']);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $current_password = $request->input('current_password', null);
        $new_password = $request->input('new_password', null);

        if ($validator->fails()) {
            return response()->json(['message' => 'error', 'errors' => $validator->errors()]);
        } else {

            $check_pass = Hash::check($current_password, Auth::user()->password);
            if ($check_pass) {
                $change =  User::find(auth()->user()->id)->update(['password' => Hash::make($new_password)]);
                return response()->json("success");
            }
        }
    }

    public function forgotpassword(Request $request)
    {
        $code_pass = $request->input('code_pass');
        $email = $request->input('email');
        $new_password = $request->input('new_password');

        $user = User::where('email', $email)->first();

        if ($code_pass) {
            $check = ActiveUser::where([
                'email' => $email,
                'code' => $code_pass,
            ])->first();

            $dateNow = Carbon::now();

            if ($check) {
                $dateCheck = Carbon::parse($check->created_at)->addHour();

                if ($dateCheck >= $dateNow) {

                    $change =  User::find($user->id)->update(['password' => Hash::make($new_password)]);
                    $check->delete();

                    return response()->json(['message' => 'success']);

                } else {

                    return response()->json(['message' => 'error']);
                }
            } else {
                return response()->json(['message' => 'error']);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'error', 'errors' => $validator->errors()]);
            } else {
                if($user){
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
                return response()->json(['message' => 'not found user']);
            }
        }

    }
}