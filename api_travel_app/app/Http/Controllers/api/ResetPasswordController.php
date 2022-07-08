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
            $TUpdate->phone = $request->input('phone', $TUpdate->phone);
            $TUpdate->avatar = $request->input('avatar', $TUpdate->avatar);
            $TUpdate->gender = $request->input('gender', $TUpdate->gender);
            $TUpdate->birthday = $request->input('birthday', $TUpdate->birthday);
            $TUpdate->save();
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
}
