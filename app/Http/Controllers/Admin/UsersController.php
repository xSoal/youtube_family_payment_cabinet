<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index () {
        $users  = User::all();
        return response()->json($users, 200);
    }

    public function add ( Request $request ) {

        $request->validate([
            "name" => "string|required",
            "email" => "string|required|unique:users",
            "password" => "string|required",
            "password_confirm" => "string|required|same:password"
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->api_token  = Str::random(80);
        $user->save();

        return response()->json('ok', 200);
    }

    public function edit ( Request $request, $user_id ) {



        $user = User::findOrFail($user_id);

        $request->validate([
            "name" => "string|required",
            "email" => [
                'email',
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            "password" => "",
            "password_confirm" => "same:password"
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($request->input('password')){
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return response()->json('ok', 200);
    }

    public function delete ( Request $request, $user_id ) {

        $user = User::findOrFail($user_id);
        $user->delete();

        return response()->json('ok', 200);
    }
}
