<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $paid = $request->input('paid');
        $date = $request->input('date', Carbon::now());
        $date = Carbon::parse($date);

        $type = $request->input('type');
        //type == 1 : is paid
        if ($paid == 1) {
            if ($type == 'month') {
                $get_booking = booking::with(['tour', 'user'])
                    ->whereYear('date_of_booking', $date->year)
                    ->whereMonth('date_of_booking', $date->month)
                    ->where('is_paid', 1)
                    ->where('is_confirmed', 1)
                    ->get();
            } else {
                if ($type == 'week') {
                    $get_booking = booking::with(['tour', 'user'])
                        ->whereWeek('date_of_booking', $date->weekOfMonth)
                        ->where('is_paid', 1)
                        ->where('is_confirmed', 1)
                        ->get();
                } else {
                    $get_booking = booking::with(['tour', 'user'])
                        ->whereDate('date_of_booking', $date)
                        ->where('is_paid', 1)
                        ->where('is_confirmed', 1)
                        ->get();
                }
            }
        } else {
            if ($type == 'month') {
                $get_booking = booking::with(['tour', 'user'])
                    ->whereYear('date_of_booking', $date->year)
                    ->whereMonth('date_of_booking', $date->month)
                    ->where('is_paid', 2)
                    ->where('is_confirmed', 1)
                    ->get();
            } else {
                if ($type == 'week') {
                    $get_booking = booking::with(['tour', 'user'])
                        ->whereWeek('date_of_booking', $date->weekOfMonth)
                        ->where('is_paid', 2)
                        ->where('is_confirmed', 1)
                        ->get();
                } else {
                    $get_booking = booking::with(['tour', 'user'])
                        ->where('is_paid', 2)
                        ->where('is_confirmed', 1)
                        ->get();
                }
            }
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
    public function destroy($id)
    {
        //
    }
}