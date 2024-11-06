<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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

    public function register(RegisterRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email already exists');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'user',
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();
            if (! $user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => \Hash::make(rand(100000, 999999)),
                    'country_code' => 'IN',
                    'phone_number' => rand(1000000000, 9999999999),
                ]);
            }

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/register');
        }
    }
}
