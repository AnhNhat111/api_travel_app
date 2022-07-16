<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\role;
use App\Models\tour;
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
        // type == 1 : is paid
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
                    ->where('is_confirmed', 2)
                    ->get();
            } else {
                if ($type == 'week') {
                    $get_booking = booking::with(['tour', 'user'])
                        ->whereWeek('date_of_booking', $date->weekOfMonth)
                        ->where('is_paid', 2)
                        ->where('is_confirmed', 2)
                        ->get();
                } else {
                    $get_booking = booking::with(['tour', 'user'])
                        ->where('is_paid', 2)
                        ->where('is_confirmed', 2)
                        ->get();
                }
            }
        }
        return response()->json($get_booking);
    }

    public function booking_confirmed(Request $request)
    {
        $date = $request->input('date', Carbon::now());
        $date = Carbon::parse($date);

        $get_booking = booking::with(['code', 'user'])
            ->whereYear('date_of_booking', $date->year)
            ->whereMonth('date_of_booking', $date->month)
            ->where('is_paid', 1)
            ->where('is_confirmed', 1)
            ->orderBy('date_of_booking', 'desc')
            ->get();

        return view('admin.pages.bookingmanagement.bookingConfirmed', [
            'data' => $get_booking
        ]);
    }

    public function booking_not_confirmed(Request $request)
    {
        $date = $request->input('date', Carbon::now());
        $date = Carbon::parse($date);

        $get_booking = booking::with(['code', 'user'])
            ->whereYear('date_of_booking', $date->year)
            ->whereMonth('date_of_booking', $date->month)
            ->where('is_paid', 2)
            ->where('is_confirmed', 2)
            ->orderBy('date_of_booking', 'desc')
            ->get();

        return view('admin.pages.bookingmanagement.bookingNotConfirmed', [
            'data' => $get_booking
        ]);
    }

    public function destroy($id)
    {
        $delete = booking::where('id', $id);

        $data = $delete->get();

        if (count($data) > 0) {
            $delete->delete();
        }

        return response()->json($data);
    }
}