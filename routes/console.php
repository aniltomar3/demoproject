<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function(){
 Log::info(Carbon::now());
})->everyFiveSeconds();
