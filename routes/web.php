<?php

use App\Http\Controllers\LoginController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.welcome');
    })->name('home');
});


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login_page')->name('login');
    Route::post('login', 'login_req')->name('login_req');
    Route::get('register', 'register_page')->name('register');
    Route::post('register', 'register_req')->name('register_req');

    Route::get('logout', 'logout')->name('logout');
});
