<?php

use App\Http\Controllers\Ai\AiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::get('stlink',function(){
    Artisan::call('storage:link');
});

require __DIR__.'/dashboard/web.php';
require __DIR__.'/user/web.php';
