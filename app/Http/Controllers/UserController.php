<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::paginate(10);
        return view('pages.users', compact('Users'));
    }

    public function addNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->NAME = $request->name;
        $user->USER_TYPE = $request->designation;
        $user->EMAIL = $request->email;
        $user->PASSWORD = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'User added successfully');
    }

    public function updateUser(Request $request)
    {
        $user = User::where('EMAIL', $request->email)->first();
        // dd($user);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->NAME = $request->name;
        $user->USER_TYPE = $request->designation;
        if ($request->filled('password')) {
            $user->PASSWORD = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function deleteUser(Request $request)
    {
        $user = User::where('USER_ID', $request->userid)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('success', 'User deleted successfully');
        }
    }


    public function logout()
    {
        Session::flush();
        request()->session()->invalidate();
        return redirect('login');
    }
}
