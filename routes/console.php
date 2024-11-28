<?php

use App\Console\Commands\GenerateShipRocketToken;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    new GenerateShipRocketToken;
})->cron('0 0 */10 * *');
