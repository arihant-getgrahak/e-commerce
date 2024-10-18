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
            "email" => $request->email,
            "password" => $request->password
        ]);

        if (!$auth) {
            return back()->with("error", "Invalid email or password");
        }

        return redirect()->route("admin");
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        if (!$user) {
            return back()->with("error", "Something went wrong");
        }

        return response()->json([
            "message" => "User created successfully",
            "user" => $user
        ]);
    }
}
