<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = role::paginate(15)->sortBy('name');
        return response()->json($data);
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
        $roles = $request->input('roles');
        $data = [];

        if ($roles) {
            foreach ($roles as $role) {
                $TNew = role::create([
                    'name' => $role["name"],
                    'status' => 1
                ]);
                $data[] = $TNew;
            }
        } else {
            $TNew = role::create([
                'name' => $request["name"],
                'status' => 1
            ]);
            $data = $TNew;
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $roles = $request->input('roles');
        $data = [];
        if ($roles) {
            foreach ($roles as $role) {
                $TUpdate = role::find($roles["id"]);
                if ($TUpdate) {
                    $TUpdate->name = isset($role["name"]) ? $role["name"] : $TUpdate->name;
                    $TUpdate->status = isset($role["status"]) ? $role["status"] : $TUpdate->status;
                    $TUpdate->save();

                    $data[] = $TUpdate;
                } else {
                    return response()->json(["message" => "not found roles"]);
                }
            }
        } else {
            $TUpdate = role::find($id);
            if ($TUpdate) {
                $TUpdate->name = $request->input('name', $TUpdate->name);
                $TUpdate->status = $request->input('status', $TUpdate->status);

                $TUpdate->save();

                $data = $TUpdate;
            }
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $ids)
    {
        $ids = $request->input('ids');
        $delete = role::whereIn('id', $ids);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }

        return response()->json($data);
    }
}