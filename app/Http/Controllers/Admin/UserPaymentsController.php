<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPaymentsController extends Controller
{
    public function get_all_payments(){


        $payments = DB::table('users_payments')->get();


        return response()->json($payments, 200);

    }


    public function create_user_payment(Request $request, $user_id){
        $user = User::findOrFail($user_id);

        $request->validate([
            "amount" => "required",
            "date" => "string|required"
        ]);


        $q = DB::table("users_payments")->insert([
            'user_id' => $user_id,
            'amount' => $request->input('amount'),
            'date' => $request->input('date')
        ]);

        DB::table('users')
            ->where('id', $user_id)
            ->increment('balance', $request->input('amount'));

        if(!$q){
            return response()->json(["errors" => ["error in payment create"]], 403);
        }

        return response()->json("ok", 200);
    }


    public function delete_user_payment ( $payment_id ){
        DB::table('users_payments')->where('id', '=', $payment_id)->delete();

        return response()->json("ok", 200);
    }


    public function update_user_payment( Request $request, $payment_id ) {

        $request->validate([
            "amount" => "required",
            "date" => "string|required"
        ]);

        DB::table('users_payments')
            ->where('id', $payment_id)
            ->update([
                'amount' => $request->input('amount'),
                'date' => $request->input('date')
            ]);



        return response()->json("ok", 200);
    }

}
