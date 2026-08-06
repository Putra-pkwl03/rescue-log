<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Jalankan pengambilan data BMKG setiap 3 menit
Schedule::command('disaster:fetch-bmkg')->everyThreeMinutes();