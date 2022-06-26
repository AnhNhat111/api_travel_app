<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\location;
use Illuminate\Http\Request;
use App\Models\tour;
use Carbon\Carbon;

class UserTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::now());
        $vehicle = $request->input('vehicle');
        $date_to = $request->input('date_to');
        $date_from = $request->input('date_from');
        $price_adult = $request->input('price_adult');
        $price_child = $request->input('price_adult');
        $location_start = $request->input('location_start');
        $location_end = $request->input('location_end');
        $available_capacity = $request->input('available_capacity');

        $fillter_tour = $request->input('fillter_tour');
        $type = $request->input('type', 'ASC');

        $avaiable_tour = tour::get();
        foreach($avaiable_tour as $avaiable){
            $avaiable_slot[] = $avaiable->available_capacity;
        }

        if($date){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->where('created_at', $date)
            ->orWhere('vehicle_id', $vehicle)
            ->get();
        }

        if($vehicle){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->where('vehicle_id', $vehicle)
            ->get();
        }

        if($date_to && $date_from){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->whereBetween('date_to',[
                'date_to' => $date_to,
                'date_from' => $date_from
            ])
            ->get();
        }

        // if($price){
        //     $tour = tour::with(['vehicle', 'images','start_location','end_location'])
        //     ->where('price', $price)
        //     ->get();
        // }

      
        //search in start_location_id
        if($location_start && $location_end){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->where("location_start", $location_start)
            ->where("location_start", $location_end)
            ->get();
        }

        if($available_capacity){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->orderBy('available_capacity', 'DESC')
            ->get();
        }

        if($type == 'adult'){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->orderby('price_adult', $price_adult)
            ->get();
        }

        if($type == 'price_child'){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->orderby('price_child', $price_child)
            ->get();
        }

        if($type){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->orderby('available_capacity', $type)
            ->get();
        }

        if($fillter_tour){
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->where('created_at', $date)
            ->orWhere('vehicle_id', $vehicle)
            ->orwhere('available_capacity', $available_capacity)
            ->orwhere("location_start", "LIKE", "%{$location_start}%")
            ->orwhere("location_start", "LIKE", "%{$location_end}%")
            ->orwhere('price_child', $price_child)
            ->orwhere('price_adult', $price_adult)
            ->get();
        }else{
            $tour = tour::with(['vehicle', 'images','start_location','end_location'])
            ->get();
        }

        return response()->json($tour);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    public function destroy($id)
    {
        //
    }

    public function get_location(){
            $loaction = location::select('id', 'name')->get();
        return response()->json($loaction);
    }

    public function get_tour_in_location($id){
        $get_tour = tour::where('start_location_id', $id)->get();
        return response()->json($get_tour);
    }

    public function get_tour_by_id($id){
        $get_tour = tour::with(['vehicle', 'images','start_location','end_location'])
        ->where('id', $id)->get();
        return response()->json($get_tour);
    }
}   
