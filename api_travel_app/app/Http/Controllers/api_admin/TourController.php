<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tour;
use Validator;
use Carbon\Carbon;


class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tours = $request->input('tours');
       
        $date_now = $date->format('Ymdhis');
        dd($date_now);
            if($tours){
            $data = [];
              foreach($tours as $tour){
                
                $TNew = tour::create([
                    'code' => "NT".rand(1000000000, 9999999999),
                    'name' =>  $tour["name"] ?? null,
                    'date_to' => $tour["date_to"] ?? null,
                    'date_from' => $tour["date_from"] ?? null,
                    'schedule' => $tour["schedule"] ?? null,
                    'hotel' => $tour["hotel"] ?? null,
                    'image' => $tour["image"] ?? null,
                    'price' => $tour["price"] ?? null,
                    'start_location_id' => $tour["start_location_id"] ?? null,
                    'end_location_id' => $tour["end_location_id"] ?? null,
                    'capacity' => $tour["capacity"] ?? null,
                    'available_capacity' => $tour["available_capacity"] ?? null,
                    'type_id' => $tour["type_id"] ?? null,
                    'vehicle_id' => $tour["vehicle_id"] ?? null,
                    'promotion_id' => $tour["promotion_id"] ?? null,
                    'status' => 1
                ]);
                $data[] = $TNew;
              }  
            } 
            else{
               
                $code = "NT".rand(1000000000, 9999999999);
               
                $TNew = tour::create([
                   'code' => "NT".rand(1000000000, 9999999999),
                   'name' => $request->name ?? null,
                   'date_to' => $request->date_to ?? null,
                   'date_from' => $request->date_from ?? null,
                   'schedule' => $request->schedule ?? null,
                   'hotel' => $request->hotel ?? null,
                   'image' => $request->image ?? null,
                   'price' => $request->price ?? null,
                   'start_location_id' => $request->start_location_id ?? null,
                   'end_location_id' => $request->end_location_id ?? null,
                   'capacity' => $request->capacity ?? null,
                   'available_capacity' => $request->available_capacity ?? null,
                   'type_id' => $request->type_id ?? null,
                   'vehicle_id' => $request->vehicle_id ?? null,
                   'promotion_id' => $request->promotion_id ?? null,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$ids)
    {
        $ids = $request->input('ids');
        $delete = Shift::whereIn('id', $ids);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }


        return response()->json($data);
    }
}
