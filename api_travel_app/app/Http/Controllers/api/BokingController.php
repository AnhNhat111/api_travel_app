<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;


class BokingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type', 0);
        //type == 1 : is not paid
        if ($type == 1) {
            $get_booking = booking::where('user_id', auth()->user()->id)
                ->where('is_paid', 2)
                ->where('is_confirmed', 1)
                ->get();
        } else {
            $get_booking = booking::where('user_id', auth()->user()->id)
                ->where('is_paid', 1)
                ->where('is_confirmed', 1)
                ->get();
        }
        return response()->json($get_booking);
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
        $date_of_booking = $request->input('date', Carbon::now());
        $date = $date_of_booking->format('Y-m-d h:i:s');

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tour_id' => 'required',
            'unit_price' => 'required',
            
            'is_confirmed' => 'required',

            'is_paid' => 'required',
            'quantity' => 'required',
            'date_of_payment' => 'required',
            'booking_details' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $TNew = booking::create([
            'user_id' => Auth()->user()->id,
            'tour_id' => $request->tour_id ?? null,
            'unit_price' => $request->unit_price ?? null,
            'total_price' => $request->unit_price *  $request->quantity   ?? null,
            'is_confirmed' => $request->is_confirmed ?? 1,
            'date_of_booking' => $date ?? null,
            'is_paid' => $request->is_paid ?? 0,
            'quantity' => $request->quantity ?? null,
            'date_of_payment' => $request->date_of_payment ?? null,
            'booking_details' => $request->booking_details ?? null,
            'status' => $request->status ?? 1
        ]);
        $data = $TNew;
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
        $booking = booking::find($id);
        if ($booking) {
            $booking->is_paid = $request->input('is_paid', 1);;
            $booking->is_confirmed = $request->input('is_confirmed', 1);;
            $booking->status = $request->input('status', 1);

            $data = $booking;
        }
        return response()->json($data);
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
}