<?php

namespace App\Http\Controllers;

use Artisan;
use File;
use Illuminate\Http\Request;
use Validator;

class AdminSettingController extends Controller
{
    public function shiprocketView()
    {
        $data = [
            'username' => env('SHIPROCKET_USERNAME'),
            'password' => env('SHIPROCKET_PASSWORD'),
            'channelId' => env('SHIPROCKET_CHANNEL_ID'),
        ];

        return view('admin.setting.shiprocket', compact('data'));
    }

    public function forexView()
    {
        return view('admin.setting.forex');
    }

    public function changeCredentials(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'channelId' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate->errors());
        }

        $data = $request->only(['username', 'password', 'channelId']);

        $this->updateEnv([
            'SHIPROCKET_USERNAME' => $data['username'],
            'SHIPROCKET_PASSWORD' => $data['password'],
            'SHIPROCKET_CHANNEL_ID' => $data['channelId'],
        ]);

        return back()->with('success', 'Credentials updated');
    }

    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');

        if (! File::exists($envPath)) {
            return false;
        }

        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $escaped = preg_quote('='.env($key), '/');
            $envContent = preg_replace("/^{$key}{$escaped}/m", "{$key}={$value}", $envContent) ?? $envContent;

            if (! str_contains($envContent, "{$key}=")) {
                $envContent .= "\n{$key}={$value}";
            }
        }

        File::put($envPath, $envContent);

        Artisan::call('config:cache');
        Artisan::call('config:clear');
    }
}
