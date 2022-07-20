<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_user = User::get();

        return view('admin.pages.quanlytaikhoan.index', [
            'data' => $get_user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'uid' => '',
            'password' => bcrypt(000000),
            'avatar' => "images",
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birth_day'),
            'status' => 1,
            'login_method_id' => 1,
        ]);
        $user->save();
        return view('admin.pages.quanlytaikhoan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this_user = User::find($id);
        if ($this_user) {
            return response()->json($this_user);
        }
        return reponse()->json(['message' => 'not found user']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.quanlytaikhoan.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = User::find($id);

        if ($update) {
            $update->name =  $request->input('name', $update->name);
            $update->email =  $request->input('email', $update->email);
            $update->uid =  $request->input('uid', $request->uid);
            $update->password =  $request->input('password', $update->password);
            $update->birthday =  $request->input('birthday', $update->birthday);
            $update->gender =  $request->input('gender', $update->gender);
            $update->status =  $request->input('status', $update->status);
            $update->save();
            return response()->json([
                'message' => 'update sussces',
                'data' => $update
            ]);
        } else {
            return response()->json(['message' => 'not found user']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::where('id', $id);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }

        return response()->json($data);
    }
}