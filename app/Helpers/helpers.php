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

    if (! function_exists('getExchangeRate')) {
        function getExchangeRate()
        {
            try {
                $res = Http::get('https://v6.exchangerate-api.com/v6/719e8ecf2efbd5dfaef4c8f5/latest/INR');

                if ($res->successful()) {
                    $data = $res->json();

                    return [
                        'status' => true,
                        'data' => $data['conversion_rates'],
                    ];
                }

                return [
                    'status' => false,
                    'data' => $res->json()['unsupported-code'],
                ];
            } catch (\Exception $e) {
                return [
                    'status' => false,
                    'data' => $e->getMessage(),
                ];
            }
        }
    }

    if (! function_exists('getCurrencySymbol')) {
        function getCurrencySymbol($country)
        {
            try {
                $currencyCode = null;
                $currencySymbol = null;
                $response = Http::get("https://restcountries.com/v3.1/alpha/{$country}");
                if ($response->ok()) {
                    $data = $response->json();
                    $currencies = $data[0]['currencies'];
                    $currencyCode = array_keys($currencies)[0] ?? 'INR';
                    $currencySymbol = array_values($currencies)[0]['symbol'] ?? '₹';
                }

                return [
                    'status' => true,
                    'data' => $currencySymbol,
                    'currency_code' => $currencyCode,
                ];
            } catch (\Exception $e) {
                return [
                    'status' => false,
                    'data' => $e->getMessage(),
                ];
            }
        }
    }
}
