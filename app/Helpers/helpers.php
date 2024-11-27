<?php

if (! function_exists('getTelCode')) {
    function getTelCode($data)
    {
        $response = Http::get("https://restcountries.com/v3.1/alpha/{$data}");
        if ($response->ok()) {
            $data = $response->json();
            $telephoneCode = $data[0]['idd']['root'].$data[0]['idd']['suffixes'][0];

            return [
                'code' => $telephoneCode,
                'status' => true,
            ];
        } else {
            return [
                'code' => 'Country not found.',
                'status' => false,
            ];
        }
    }
}

if (! function_exists('getLocationInfo')) {
    function getLocationInfo(string $ip): array
    {
        try {
            $response = Http::get("http://ipinfo.io/{$ip}/json");

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['bogon']) && $data['bogon'] == 1) {
                    return [
                        'status' => false,
                        'message' => 'Bogon IP address detected. Unable to determine location.',
                    ];
                }

                return [
                    'status' => true,
                    'data' => $data,
                ];
            }

            return [
                'status' => false,
                'message' => 'Unable to retrieve location data.',
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'message' => 'An error occurred while fetching location data.',
            ];
        }
    }
}
