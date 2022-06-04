<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;
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
        if($type === 1){
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

            $check_pass = Hash::check($current_password,Auth::user()->password);
            if($check_pass){
               $change =  User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
                return response()->json("success");
            }
        }
    }

    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
  
        return response()->json([
        'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update($request->only('password'));
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
        ]);
    }
}
