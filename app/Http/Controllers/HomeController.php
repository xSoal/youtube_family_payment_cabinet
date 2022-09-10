<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function create_periods()
    {
        $months = [];
        $date_period_start = DB::select('select * from config where name="date_payment_start"')[0]->value;

        $months[] = $date_period_start;

        $cur_month = date('Y-m', time());

        $i_month = $date_period_start;
        do {
            $i_month = date('Y-m', strtotime('+1 month', strtotime($i_month)));
            $months[] = $i_month;
        } while ($cur_month > $i_month);

        foreach ($months as $month_date) {
            $is_isset = DB::table('months_payments')->where('date', $month_date)->first();
            if (!$is_isset) {
                DB::table('months_payments')->insert([
                    'date' => $month_date,
                    'amount' => 150
                ]);
            }
        }


    }




}
