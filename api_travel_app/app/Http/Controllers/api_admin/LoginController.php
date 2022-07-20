<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

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

            if (!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return back()->withErrors([
                    'message' => 'The email or password is incorrect, please try again',
                ]);
            }
            return redirect()->intended(route('admin.statiscal'));
        } else {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}