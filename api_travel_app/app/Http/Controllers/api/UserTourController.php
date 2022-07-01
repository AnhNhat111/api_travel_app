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

    public function search(Request $request)
    {
        $search = "";
        $search = $request->input("key");
        $shop_id = $request->input('shopId');

        if (!empty($request->input("key"))) {
            $search = $request->input("key");
        }

        $data = tour::where('shop_id', $shop_id)
            ->orWhere("code", $search)
            ->where("name", "LIKE", "%{$search}%")->orderBy("id", "DESC")->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::now());
        $vehicle = $request->input('vehicle');
        $date_to = $request->input('date_to');
        $date_from = $request->input('date_from');
        $price_adult = $request->input('price_adult');
        $price_child = $request->input('price_child');
        $location_start = $request->input('location_start');
        $location_end = $request->input('location_end');
        $available_capacity = $request->input('available_capacity');
        $vehicle = $request->input('vehicle');

        $price_adult1 = $request->input('price_adult1');
        $price_adult2 = $request->input('price_adult2', 30000000);
        $fillter_tour = $request->input('fillter_tour');


        if ($price_adult1 && $price_adult2) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('price_adult1', '>=', $price_adult1)
                ->Where('price_adult2', '<=', $price_adult2)
                ->get();
        } else {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('price_adult1', '>=', $price_adult1)
                ->where('price_adult2', '<=', $price_adult2)
                ->get();
        }


        if ($date) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('created_at', $date)
                ->where('capacity', '>', 0)
                ->get();
        }

        if ($vehicle) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('vehicle_id', $vehicle)
                ->where('capacity', '>', 0)
                ->get();
        }

        if ($date_from) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('date_from', $date_from)
                ->where('capacity', '>', 0)
                ->get();
        }



        //search in start_location_id
        if ($location_start && $location_end) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where("location_start", $location_start)
                ->where("location_start", $location_end)
                ->get();
        }

        if ($available_capacity) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->orderBy('available_capacity', 'DESC')
                ->get();
        }


        if ($fillter_tour) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('created_at', $date)
                ->orWhere('vehicle_id', $vehicle)
                ->orWhere('available_capacity', $available_capacity)
                ->orWhere("location_start", "LIKE", "%{$location_start}%")
                ->orWhere("location_start", "LIKE", "%{$location_end}%")
                ->orWhere('price_child', $price_child)
                ->orWhere('price_adult', $price_adult)
                ->orderby('created_at', 'DESC')
                ->get();
        } else {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
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

    public function get_location()
    {
        $loaction = location::select('id', 'name')->get();
        return response()->json($loaction);
    }

    public function get_tour_in_location($id)
    {
        $get_tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
            ->where('start_location_id', $id)->get();
        return response()->json($get_tour);
    }

    public function get_tour_by_id($id)
    {
        $get_tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
            ->where('id', $id)->get();
        return response()->json($get_tour);
    }
}