<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //(new \App\Jobs\SendWelcomeEmail())->handle();
    //\App\Jobs\SendWelcomeEmail::dispatch()->delay(5); // 5 seconds delay
    //\App\Jobs\SendWelcomeEmail::dispatch();

    foreach (range(1, 2) as $i) {
        \App\Jobs\SendWelcomeEmail::dispatch();
    }

    \App\Jobs\ProcessPayment::dispatch()->onQueue('payments'); //higher priority

    return view('welcome');
});
