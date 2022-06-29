<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\tour;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;


class UserBookingController extends Controller
{
    public function search(Request $request)
    {
        $search = "";
        $search = $request->input("key");
        $shop_id = $request->input('shopId');

        if (!empty($request->input("key"))) {
            $search = $request->input("key");
        }

        $data = tour::where('shop_id', $shop_id)->where("name", "LIKE", "%{$search}%")->orderBy("id", "DESC")->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function index(Request $request)
    {
        $type = $request->input('type', 0);

        //type == 1 : is paid
        if ($type == 1) {
            $get_booking = booking::with(['user', 'tour'])
                ->where('user_id', auth()->user()->id)
                ->where('is_paid', 1)
                ->where('is_confirmed', 1)
                ->get();
        } else {
            $get_booking = booking::with(['user', 'tour'])
                ->where('user_id', auth()->user()->id)
                ->where('is_paid', 1)
                ->where('is_confirmed', 2)
                ->get();
        }
        return response()->json($get_booking);
    }


    public function store(Request $request)
    {

        $date_of_booking = $request->input('date', Carbon::now());
        $date = $date_of_booking->format('Y-m-d h:i:s');

        $validator = Validator::make($request->all(), [
            'tour_id' => 'required',
            'is_confirmed' => 'required',

            'is_paid' => 'required',
            'quantity_child' => 'required',
            'quantity_adult' => 'required',
            'unit_price_child' => 'required',
            'unit_price_adult' => 'required',
            'date_of_payment' => 'required',
            'booking_details' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $quantity = $request->quantity_child + $request->quantity_adult;
        $TNew = booking::create([
            'user_id' => Auth()->user()->id,
            'tour_id' => $request->tour_id ?? null,
            'quantity_child' => $request->quantity_child ?? 0,
            'unit_price_child' => $request->unit_price_child ?? 0,
            'quantity_adult' => $request->quantity_adult ?? 0,
            'unit_price_adult' => $request->unit_price_adult ?? 0,
            'quantity' => $quantity ?? 0,
            'total_price' => $request->unit_price_child * $request->quantity_child + $request->unit_price_adult * $request->quantity_adult ?? 0,
            'is_confirmed' => $request->is_confirmed ?? 1,
            'date_of_booking' => $date ?? null,
            'is_paid' => $request->is_paid ?? 0,
            'date_of_payment' => $request->date_of_payment ?? null,
            'booking_details' => $request->booking_details ?? null,
            'status' => $request->status ?? 1
        ]);
        $data = $TNew;
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $booking = booking::find($id);
        if ($booking) {
            $date = Carbon::now()->format('Y-m-d h:m:s');
            $booking->date_of_payment = $date;
            $booking->is_paid = $request->input('is_paid', 1);
            $booking->is_confirmed = $request->input('is_confirmed', 1);
            $booking->status = $request->input('status', 1);
            $booking->quantity_child = $request->input('quantity_child', $booking->quantity_child);
            $booking->unit_price_child = $request->input('unit_price_child', $booking->unit_price_child);
            $booking->quantity_adult = $request->input('quantity_adult', $booking->quantity_adult);
            $booking->unit_price_adult = $request->input('unit_price_adult', $booking->unit_price_adult);

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
    public function destroy(Request $request, $ids)
    {
        $ids = $request->input('ids');
        $delete = booking::whereIn('id', $ids);

        if ($delete->status == 2) {
            $data = $delete->get();

            if (count($data) > 0) {
                $delete->delete();
            }
        }
        return response()->json($data);
    }
}