<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodsController extends Controller
{



    public function get_start_periods_data ( Request $request )
    {
        $date_period_start = DB::select('select * from config where name="date_payment_start"')[0]->value;

        return response()->json($date_period_start, 200);

    }


    public function create_periods_for_users( Request $request , $user_id)
    {
        $user = User::findOrFail($user_id);

        $request->validate([
            'start_from' => 'string',
            'user_in_payment_count' => 'integer'
        ]);

        $start_from = $request->input('start_from');
        $start_to = $request->input('start_to');
        $user_in_payment_count = $request->input('user_in_payment_count');

        if(!$start_to) $start_to = date("Y-m");

        $periods_for_user = [];
        $_cur_month = $start_from;

        do {
            $periods_for_user[] = $_cur_month;
            $_cur_month = date('Y-m', strtotime('+1 month', strtotime($_cur_month)));
        } while( $_cur_month <= $start_to );

        $users_payments_month = DB::table('users_months_payments')->where('user_id', $user_id)->get();
        foreach ($periods_for_user as $month_date) {
            $is_isset = $users_payments_month->contains(function($value,$key) use($month_date){
                return $value->date === $month_date;
            });

            if (!$is_isset) {
                DB::table('users_months_payments')->insert([
                    'date' => $month_date,
                    'user_id' => $user_id,
                    'users_count' => $user_in_payment_count
                ]);
            }
        }

        self::recalculate_all_user_periods();
        return response()->json('ok', 200);
    }


    public function get_user_periods(Request  $request, $user_id){
        $user = User::findOrFail($user_id);

        $periods = DB::table('users_months_payments')->where('user_id', $user_id)->get();

        return response()->json($periods, 200);
    }


    public function delete_user_period(Request $request, $period_id){
        $deleted = DB::table('users_months_payments')->where('id', '=', $period_id)->delete();

        if(!$deleted){
            return response()->json(["errors" => ["cant_delete"]], 403);
        }

        return response()->json("ok", 200);
    }


    public function recalculate_all_user_periods(){
        $periods = DB::table('months_payments')->get()->toArray();
        $users_periods = DB::table('users_months_payments')->get();

        // those is assoc array user_id => [[
        // to_amount => 450
        //]]
        $users_to_payment = [];


        foreach($periods as $p){
            $current_month_users = $users_periods->filter(function($value) use ($p){
                return $value->date === $p->date;
            });

            $month_price = $p->amount;

            $all_subs = $current_month_users->reduce(function($acc, $item){
                return $acc + $item->users_count;
            });

            $month_sub_price = $month_price / $all_subs;


            foreach($current_month_users->toArray() as $user_month_payment){

                $month_amount = $month_sub_price * $user_month_payment->users_count;

                DB::table('users_months_payments')
                    ->where('id', $user_month_payment->id)
                    ->update(['price' => $month_amount]);

                $user_id = $user_month_payment->user_id;


                if(!isset($users_to_payment[$user_id])){
                    $users_to_payment[$user_id] = $month_amount;
                } else {
                    $users_to_payment[$user_id] = $users_to_payment[$user_id] + $month_amount;
                }

            }

            DB::table('users')
                ->update(['balance' => 0]);

            foreach ($users_to_payment as $user_id => $user_to_pay){
                DB::table('users')
                    ->where('id', $user_id)
                    ->update(['balance' => "-" . $user_to_pay]);
            }


            $payments = DB::table('users_payments')->get()->toArray();

            foreach ($payments as $p){
                DB::table('users')
                    ->where('id', $p->user_id)
                    ->increment('balance', $p->amount);
            }


        }


       return response()->json('ok', 200);

    }



    public function calculate_users_payment_for_period($period){

    }

}
