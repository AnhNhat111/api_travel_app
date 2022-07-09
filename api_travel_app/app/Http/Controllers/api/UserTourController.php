<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\location;
use Illuminate\Http\Request;
use App\Models\tour;
use App\Models\vehicle;
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

        if (!empty($request->input("key"))) {
            $search = $request->input("key");
        }

        $data = tour::orWhere("code", $search)
            ->where("name", "LIKE", "%{$search}%")->orderBy("id", "DESC")->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::now());
        $vehicle = $request->input('vehicle');
        $date_to = $request->input('date_to', Carbon::now());
        $date_from = $request->input('date_from');
        $price_adult = $request->input('price_adult');
        $price_child = $request->input('price_child');
        $location_start = $request->input('location_start');
        $location_end = $request->input('location_end');
        $available_capacity = $request->input('available_capacity');
        $vehicle = $request->input('vehicle');
        $type = $request->input('type');

        $price_adult1 = $request->input('price_adult1');
        $price_adult2 = $request->input('price_adult2', 30000000);
        $fillter_tour = $request->input('fillter_tour');
        $tour = [];

        if ($type == 'price_adult') {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->whereBetween('price_adult', [
                    $price_adult1,
                    $price_adult2,
                ])->get();
            return response()->json($tour);
        }

        if ($type == 'date_to') {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->whereBetween('date_to', [$date_to, $date_from])
                ->where('capacity', '>', 0)
                ->get();
            return response()->json($tour);
        }

        if ($type == 'date_from') {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->whereBetween('date_from', [$date_to, $date_from])
                ->where('capacity', '>', 0)
                ->get();
            return response()->json($tour);
        }

        if ($type == 'date') {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->whereBetween('date_to', [$date_to, $date_from])
                ->where('capacity', '>', 0)
                ->get();
            return response()->json($tour);
        }

        if ($type == 'vehicle') {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('vehicle_id', $vehicle)
                ->where('capacity', '>', 0)
                ->get();
            return response()->json($tour);
        }


        //search in start_location_id
        if ($location_start && $location_end) {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where("start_location_id", $location_start)
                ->where("end_location_id", $location_end)
                ->get();
            return response()->json($tour);
        }

        if ($type == 'available_capacity') {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->whereBetween('available_capacity', [0, $available_capacity])
                ->orderBy('available_capacity', 'DESC')
                ->get();
            return response()->json($tour);
        }


        if ($type == "fillter") {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->where('date_from', $date_from)
                ->where('date_to', $date_to)
                ->orWhere('vehicle_id', $vehicle)
                ->orWhere('available_capacity', $available_capacity)
                ->orWhere("location_start", $location_start)
                ->orWhere("location_start", $location_end)
                ->orWhere('price_child', $price_child)
                ->whereBetween('price_adult', [
                    $price_adult1,
                    $price_adult2,
                ])
                ->orderby('created_at', 'DESC')
                ->get();
            return response()->json($tour);
        } else {
            $tour = tour::with(['vehicle', 'images', 'start_location', 'end_location'])
                ->paginate(15);
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
    public function update(Request $request, $booking_id)
    {
        $tour_id = $request->input('tour_id');

        $total_booking_quantity = booking::where('id', $booking_id)
            ->select('quantity')
            ->first();
        $available_capacity = tour::where('id', $tour_id)
            ->select('available_capacity')
            ->first();

        (int) $update_quantity = (int) $available_capacity->available_capacity - (int)$total_booking_quantity->quantity;

        $TUpdate = tour::find($tour_id);
        if ($TUpdate) {
            $TUpdate->available_capacity = $update_quantity ?? $TUpdate->available_capacity;

            $TUpdate->save();
        }

        return response()->json($TUpdate);
    }

    public function update_user_booking(Request $request, $booking_id)
    {
        $tour_id = $request->input('tour_id');
        $quantity_current = $request->input('quantity_current');

        $total_booking_quantity = booking::where('id', $booking_id)
            ->select('quantity', 'quantity_child', 'quantity_adult')
            ->first();

        $available_capacity = tour::where('id', $tour_id)
            ->select('available_capacity')
            ->first();

        (int) $now_quantity = (int) $available_capacity->available_capacity + (int)$total_booking_quantity->quantity;

        $update_quantity_current = $now_quantity - $quantity_current;

        $TUpdate = tour::find($tour_id);
        if ($TUpdate) {
            $TUpdate->available_capacity = $update_quantity_current ?? $TUpdate->available_capacity;
            $TUpdate->save();
        }
        $Update_booking = booking::find($booking_id);
        if ($Update_booking) {
            $Update_booking->quantity = $quantity_current ?? $TUpdate->quantity;
            $Update_booking->quantity_child = $request->input('quantity_child') ?? $TUpdate->quantity_child;
            $Update_booking->quantity_adult = $request->input('quantity_adult') ?? $TUpdate->quantity_adult;

            $Update_booking->unit_price_child = $request->input('unit_price_child') ?? $TUpdate->quantity_child;
            $Update_booking->unit_price_adult = $request->input('unit_price_adult') ?? $TUpdate->quantity_adult;
            $Update_booking->total_price = $request->input('total_price') ?? $TUpdate->quantity_adult;
            $Update_booking->save();
        }
        $TUpdate->setAttribute("update_booking", $Update_booking);
        return response()->json($TUpdate);
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