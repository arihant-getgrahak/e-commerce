<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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
}
