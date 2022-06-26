<?php

namespace App\Http\Controllers\api_admin;

use App\Http\Controllers\Controller;
use App\Models\booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function statistical_tour(Request $request){
        $type = $request->input('type');
        $date = $request->input('date', Carbon::now());
      
        $date_now = Carbon::parse($date);

        $data = null;

        if($type == 'month'){
            $amount = booking::whereYear('date_of_payment',$date_now->year)
                ->whereMonth('date_of_payment', $date_now->month)
                ->select(
                    DB::raw("SUM((CASE when is_paid = 1 THEN 1  ELSE 0 END)) as is_paid "),
                    DB::raw("SUM((CASE when is_paid = 2 THEN 1  ELSE 0 END)) as is_not_paid ")
                )->get();
            $new_customer = User::whereYear('created_at',$date_now->year)
                ->whereMonth('created_at', $date_now->month)
                ->count();

            foreach($amount as $a){
                $data = $a->setAttribute('new_customer',$new_customer);
            }
          
        }else{
            $amount = booking::whereDate('date_of_payment',$date_now)
                ->select(
                    DB::raw("SUM((CASE when is_paid = 1 THEN 1  ELSE 0 END)) as is_paid"),
                    DB::raw("SUM((CASE when is_paid = 2 THEN 1  ELSE 0 END)) as is_not_paid")
                )->get();
            $new_customer = User::whereDate('created_at',$date_now)
                ->count();

            foreach($amount as $a){
                 $data = $a->setAttribute('new_customer',$new_customer);
            }
        }
        return response()->json($data);
    }
}
