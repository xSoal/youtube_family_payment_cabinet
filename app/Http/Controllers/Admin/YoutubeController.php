<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YoutubeController extends Controller
{
    //
    public function get_youtube_periods () {
        $payments = DB::table('months_payments')->get();


        return response()->json($payments, 200);

    }

    public function add_youtube_period ( Request $request ) {
        $request->validate([
            'yearMonthDate' => 'string',
            'amount' => 'integer'
        ]);

        $is_isset = !!DB::table('months_payments')->where('date', $request->yearMonthDate)->get()->count();

        if($is_isset){
            return response()->json(['message' => 'Период уже есть'], 404);
        }

        DB::table('months_payments')->insert([
            'date' => $request->yearMonthDate,
            'amount' => $request->amount,
        ]);

        return response()->json(['message' => 'Период добавлен'], 200);

    }

    public function delete_youtube_period ( Request $request, $period_id ) {
        $request->validate([
            'period_id' => 'string|integer',
        ]);

        $period = DB::table('months_payments')->where('id', $request->period_id)->delete();

        return response()->json("ok", 200); 
    }












}
