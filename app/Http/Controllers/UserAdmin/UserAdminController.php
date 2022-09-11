<?php

namespace App\Http\Controllers\UserAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
    public function index(){

        $user = Auth::user();
        $user_month_periods = DB::table("users_months_payments")
            ->where("user_id", $user->id)

            ->get();
        $user_payments = DB::table("users_payments")
            ->where("user_id", $user->id)
            ->get();

        $payments_status_of_end_month = [];
        $user_data = [];

        $temp_balance = 0;
        foreach ($user_month_periods->toArray() as $index => $m){


                $temp_balance = $temp_balance - $m->price;
                $payments_status_of_end_month[$m->date] = $temp_balance;


            $m->type = 'period';
            if(!isset($user_data[$m->date])){
                $user_data[$m->date] = [$m];
            } else {
                $user_data[$m->date][] = $m;
            }
        }


        foreach ($user_payments->toArray() as $m){
            $date = $m->date;
            $d = explode( "-", $date);
            $date = $d[0] . "-" . $d[1];

            if(isset($payments_status_of_end_month[$date])){

                foreach ($payments_status_of_end_month as $t_date => $t_m){
                    if($date <= $t_date){
                        $payments_status_of_end_month[$t_date] += $m->amount;
                    }
                }

            }


            $m->type = 'payment';

            if(!isset($user_data[$date])){
                $user_data[$date] = [$m];
            } else {
                $user_data[$date][] = $m;
            }
        }

        krsort ($user_data);


        return view('user_admin', compact('user_data', 'user', 'payments_status_of_end_month'));


    }
}
