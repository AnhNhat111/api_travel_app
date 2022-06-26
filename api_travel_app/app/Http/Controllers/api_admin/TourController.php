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
        $date = $request->input('date', Carbon::now());
        $date_now = $date->format('Ymdhis');

        if ($tours) {
            $data = [];
            foreach ($tours as $tour) {

                $TNew = tour::create([
                    'code' => "NT" . rand(1000000000, 9999999999),
                    'name' =>  $tour["name"] ?? null,
                    'date_to' => $tour["date_to"] ?? null,
                    'date_from' => $tour["date_from"] ?? null,
                    'schedule' => $tour["schedule"] ?? null,
                    'hotel' => $tour["hotel"] ?? null,
                    'image' => $tour["image"] ?? null,
                    'price_child' => $tour["price_child"] ?? null,
                    'price_adult' => $tour["price_adult"] ?? null,
                    'start_location_id' => $tour["start_location_id"] ?? null,
                    'end_location_id' => $tour["end_location_id"] ?? null,
                    'capacity' => $tour["capacity"] ?? null,
                    'available_capacity' => $tour["available_capacity"] ?? null,
                    'type_id' => $tour["type_id"] ?? null,
                    'vehicle_id' => $tour["vehicle_id"] ?? null,
                    'promotion_id' => $tour["promotion_id"] ?? null,
                    'description' => $tour["description"] ?? null,
                    'status' => 1
                ]);
                $data[] = $TNew;
            }
        } else {

            $code = "NT" . rand(1000000000, 9999999999);

            $TNew = tour::create([
                'code' => "NT" . rand(1000000000, 9999999999),
                'name' => $request->name ?? null,
                'date_to' => $request->date_to ?? null,
                'date_from' => $request->date_from ?? null,
                'schedule' => $request->schedule ?? null,
                'hotel' => $request->hotel ?? null,
                'image' => $request->image ?? null,
                'price_child' => $request->price_child ?? null,
                'price_adult' => $request->price_adult ?? null,
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
        $tours = $request->input('tours');
        $date = $request->input('date', Carbon::now());
        $date_now = $date->format('Ymdhis');

        $data = [];
        if ($tours) {
            foreach ($tours as $tour) {
                $TUpdate = tour::find($tour["id"]);
                if ($TUpdate) {
                    // $TUpdate->code = isset($tour['code']) ? $tour['code'] : $TUpdate->code;
                    $TUpdate->name = isset($tour['name']) ? $tour['name'] : $TUpdate->name;
                    $TUpdate->date_to = isset($tour['date_to']) ? $tour['date_to'] : $TUpdate->date_to;
                    $TUpdate->date_from = isset($tour['date_from']) ? $tour['date_from'] : $TUpdate->date_from;
                    $TUpdate->schedule = isset($tour['schedule']) ? $tour['schedule'] : $TUpdate->schedule;
                    $TUpdate->hotel = isset($tour['hotel']) ? $tour['hotel'] : $TUpdate->hotel;
                    $TUpdate->image = isset($tour['image']) ? $tour['image'] : $TUpdate->image;
                    $TUpdate->price_child = isset($tour['price_child']) ? $tour['price_child'] : $TUpdate->price_child;
                    $TUpdate->price_adult = isset($tour['price_adult']) ? $tour['price_adult'] : $TUpdate->price_adult;
                    $TUpdate->start_location_id = isset($tour['start_location_id']) ? $tour['start_location_id'] : $TUpdate->start_location_id;
                    $TUpdate->end_location_id = isset($tour['end_location_id']) ? $tour['end_location_id'] : $TUpdate->end_location_id;
                    $TUpdate->capacity = isset($tour['capacity']) ? $tour['capacity'] : $TUpdate->capacity;
                    $TUpdate->available_capacity = isset($tour['available_capacity']) ? $tour['available_capacity'] : $TUpdate->available_capacity;
                    $TUpdate->type_id = isset($tour['type_id']) ? $tour['type_id'] : $TUpdate->type_id;
                    $TUpdate->vehicle_id = isset($tour['vehicle_id']) ? $tour['vehicle_id'] : $TUpdate->vehicle_id;
                    $TUpdate->promotion_id = isset($tour['promotion_id']) ? $tour['promotion_id'] : $TUpdate->promotion_id;
                    $TUpdate->status = isset($tour['status']) ? $tour['status'] : $TUpdate->status;

                    $TUpdate->save();

                    $data[] = $TUpdate;
                } else {
                    return response()->json($data);
                }
            }
        } else {
            $TUpdate = tour::find($id);
            // $TUpdate->code = isset($request['code']) ? $request['code'] : $TUpdate->code;
            if ($TUpdate) {
                $TUpdate->name = $request->input('name', $TUpdate->name);
                $TUpdate->date_to = $request->input('date_to', $TUpdate->date_to);
                $TUpdate->date_from = $request->input('date_from', $TUpdate->date_from);
                $TUpdate->schedule = $request->input('schedule', $TUpdate->schedule);
                $TUpdate->hotel = $request->input('hotel', $TUpdate->hotel);
                $TUpdate->image = $request->input('image', $TUpdate->image);
                $TUpdate->price_child = isset($tour['price_child']) ? $tour['price_child'] : $TUpdate->price_child;
                $TUpdate->price_adult = isset($tour['price_adult']) ? $tour['price_adult'] : $TUpdate->price_adult;
                $TUpdate->start_location_id = $request->input('start_location_id', $TUpdate->start_location_id);
                $TUpdate->end_location_id = $request->input('end_location_id', $TUpdate->end_location_id);
                $TUpdate->capacity = $request->input('capacity', $TUpdate->capacity);
                $TUpdate->available_capacity = $request->input('available_capacity', $TUpdate->available_capacity);
                $TUpdate->type_id = $request->input('type_id', $TUpdate->type_id);
                $TUpdate->vehicle_id = $request->input('vehicle_id', $TUpdate->vehicle_id);
                $TUpdate->promotion_id = $request->input('promotion_id', $TUpdate->promotion_id);
                $TUpdate->status = $request->input('status', $TUpdate->status);

                $TUpdate->save();

                $data[] = $TUpdate;
            } else {
                return response()->json(["message" => "not found id tour"]);
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
        $delete = Shift::whereIn('id', $ids);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }


        return response()->json($data);
    }
}