<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $auth = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (! $auth) {
            return back()->with('error', 'Invalid email or password');
        }

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin');
        }

        return back()->with('success', 'Login successfully');

    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
            'country_code' => 'required',
            'phone_number' => 'required|string|min:10|max:10',
        ]);

        if ($validator->fails()) {
            // return response()->json([
            //     "error" => $validator->errors(),
            // ]);
            return back()->with('errors', $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'country_code' => $request->country_code,
            'phone_number' => $request->phone_number,
        ]);

        if (! $user) {
            // return response()->json([
            //     "message" => "Something went wrong",
            // ]);

            return back()->with('error', 'Something went wrong');
        }

        // return response()->json([
        //     "message" => "User created successfully",
        //     "user" => $user
        // ]);

        return back()->with('success', 'User created successfully');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
