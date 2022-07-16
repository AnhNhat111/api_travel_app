<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.pages.login.home');
    }
    public function showLoginForm()
    {
        return view('admin.pages.login.Dangnhap');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|'
        ]);

        $checkEmail = User::where('email', $request->email)->first();

        $checkRoleAdmin = role::where('user_id', $checkEmail->id)->first();

        if ($checkRoleAdmin->role_id == 1) {

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
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
            // return response()->json([
            //     'user' => auth()->user(),
            //     'access_token' => $tokenResult->accessToken,
            //     'token_type' => 'Bearer',
            //     'expires_at' => Carbon::parse(
            //         $tokenResult->token->expires_at
            //     )->toDateTimeString()
            // ]);
            return redirect()->intended(route('admin.index'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}