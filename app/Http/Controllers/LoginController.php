<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Task;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('Authentication.master');
    }

    public function authenticateUser(Request $request)
    {
        // dd($request->all());
        $UserLogin = User::where('EMAIL', $request->email)->first();
        // dd(Hash::check($request->password, $UserLogin->PASSWORD));
        if (Hash::check($request->password, $UserLogin->PASSWORD)) {
            Session::put('type', $UserLogin->USER_TYPE);
            Session::put('id', $UserLogin->USER_ID);
            Session::put('name', $UserLogin->NAME);

            return redirect('/')->with('success', 'Successfully Login');
        } else {
            return redirect()->back()->with('error', 'Login Fail');
        }
    }
}
