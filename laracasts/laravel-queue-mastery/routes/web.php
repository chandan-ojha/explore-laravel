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

    /*foreach (range(1, 2) as $i) {
        \App\Jobs\SendWelcomeEmail::dispatch();
    }*/

    //\App\Jobs\SendEmail::dispatch();

    //\App\Jobs\ProcessPayment::dispatch()->onQueue('payments'); //higher priority

    /*$chain = [
        new App\Jobs\PullRepo(),
        new App\Jobs\RunTests(),
        new App\Jobs\Deploy()
    ];*/

    $batch = [
        new App\Jobs\PullRepo("Project 1"),
        new App\Jobs\PullRepo("Project 2"),
        new App\Jobs\PullRepo("Project 3"),
    ];

    //Illuminate\Support\Facades\Bus::chain($chain)->dispatch();
    Illuminate\Support\Facades\Bus::batch($batch)
        ->allowFailures()
        ->dispatch();

    return view('welcome');
});
