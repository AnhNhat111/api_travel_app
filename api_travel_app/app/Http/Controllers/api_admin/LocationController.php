<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\location;
use Carbon\Carbon;
use Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = location::get()->sortBy('name');
        return $data;
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
        $location = $request->input('location');
        $status = $request->input('status', 1);
        $data = [];
        if ($location) {
            foreach ($location as $location) {
                $TNew = location::create([
                    'name' => $location["name"],
                    'status' => $status
                ]);
                $data[] = $TNew;
            }
        } else {
            $TNew = location::create([
                'name' => $request["name"],
                'status' => $status
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
        $locations = $request->input('locations');
        $data = [];
        if ($locations) {
            foreach ($locations as $location) {
                $TUpdate = location::find($location["id"]);
                if ($TUpdate) {
                    $TUpdate->name = isset($location["name"]) ? $location["name"] : $TUpdate->name;
                    $TUpdate->status = isset($location["status"]) ? $location["status"] : $TUpdate->status;
                    $TUpdate->save();

                    $data[] = $TUpdate;
                } else {
                    return response()->json(["message" => "not found locations"]);
                }
            }
        } else {
            $TUpdate = location::find($id);
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
        $delete = location::whereIn('id', $ids);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }


        return response()->json($data);
    }
}