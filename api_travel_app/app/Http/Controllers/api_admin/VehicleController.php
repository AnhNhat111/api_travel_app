<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vehicle;
use Carbon\Carbon;
use Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = vehicle::paginate(15)->sortBy('name');
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
        $vehicles = $request->input('vehicles');
        $data = [];
        if ($vehicles) {
            foreach ($vehicles as $vehicle) {
                $TNew = vehicle::create([
                    'name' => $vehicle["name"],
                    'status' => 1
                ]);
                $data[] = $TNew;
            }
        } else {
            $TNew = vehicle::create([
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
        $vehicles = $request->input('vehicles');
        $data = [];
        if ($vehicles) {
            foreach ($vehicles as $vehicle) {
                $TUpdate = vehicle::find($vehicles["id"]);
                if ($TUpdate) {
                    $TUpdate->name = isset($vehicle["name"]) ? $vehicle["name"] : $TUpdate->name;
                    $TUpdate->status = isset($vehicle["status"]) ? $vehicle["status"] : $TUpdate->status;
                    $TUpdate->save();

                    $data[] = $TUpdate;
                } else {
                    return response()->json(["message" => "not found vehicles"]);
                }
            }
        } else {
            $TUpdate = vehicle::find($id);
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
        $delete = vehicle::whereIn('id', $ids);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }


        return response()->json($data);
    }
}