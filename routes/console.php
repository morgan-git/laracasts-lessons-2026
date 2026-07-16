<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Schedule::command('feeds:sync')->everyFifteenMinutes();
//php artisan feeds:sync
# or just reddit
//php artisan feeds:sync reddit
