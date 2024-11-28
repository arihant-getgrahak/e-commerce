<?php

namespace App\Console\Commands;

use Http;
use Illuminate\Console\Command;

class GenerateShipRocketToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-ship-rocket-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate ShipRocket Token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = env('SHIPROCKET_USERNAME');
        $password = env('SHIPROCKET_PASSWORD');

        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $token = $response->json('token');
            config(['shiprocket.token' => $token]);
            $this->info('Shiprocket token generated and stored successfully.');
        } else {
            $this->error('Failed to generate Shiprocket token. Check your credentials.');
        }

    }
}
