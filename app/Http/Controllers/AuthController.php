<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Http;
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

        if (session('utm')) {
            $user->update(session('utm'));
        }

        if (! $user) {
            return back()->with('error', 'Something went wrong');
        }

        return back()->with('success', 'User created successfully. Please login');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();

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
            $user = User::updateOrCreate([
                'provider_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => \Hash::make(rand(100000, 999999)),
                'country_code' => 'IN',
                'phone_number' => rand(1000000000, 9999999999),
                'provider' => 'google',
                'provider_id' => $googleUser->id,
            ]);

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/register');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->with(['scope' => 'email'])->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $email = Http::post('https://graph.facebook.com/me?access_token='.$facebookUser->token.'&fields=id,name,email');

            print_r($email->json());
            dd();
            $user = User::where('email', $facebookUser->email)->first();

            $user = User::updateOrCreate([
                'provider_id' => $facebookUser->id,
            ], [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'password' => \Hash::make(rand(100000, 999999)),
                'country_code' => 'IN',
                'phone_number' => rand(1000000000, 9999999999),
                'provider' => 'facebook',
                'provider_id' => $facebookUser->id,
            ]);

            Auth::login($user);

        } catch (\Exception $e) {
            return redirect('/register');
        }
    }

    public function loginView()
    {
        return view('login');
    }

    public function registerView()
    {
        $country = 'IN';

        if (! session()->has('country')) {
            if (auth()->check()) {
                session()->put('country', auth()->user()->country);
            } else {
                $ip = request()->ip() ?? '146.70.245.84';
                $data = getLocationInfo($ip);
                $country = $data['data']['country'] ?? $country;
                session()->put('country', $country);
            }
        }

        $country = session('country', 'IN');
        $telcode = getTelCode($country)['code'];

        return view('register', compact('telcode'));
    }
}
