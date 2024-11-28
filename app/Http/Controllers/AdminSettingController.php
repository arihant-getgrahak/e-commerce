<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function changeCredentials(Request $request)
    {
        $data = $request->only(['username', 'password', 'channelId']);

        config([
            'shiprocket.email' => $data['email'],
            'shiprocket.password' => $data['password'],
            'shiprocket.channelId' => $data['channelId'],
        ]);

        if (env('shiprocket.email') === $data['email'] && env('shiprocket.password') === $data['password'] && env('shiprocket.channelId') === $data['channelId']) {
            return back()->with('success', 'Credentials updated');
        }

        return back()->with('error', 'Credentials not updated');
    }
}
