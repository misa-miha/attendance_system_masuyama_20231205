<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BreakController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[
    RegisteredUserController::class, 'showRegistrationForm'
])->name('register');

Route::post('/register',[RegisteredUserController::class,'create']
);

Route::get('/login',[AuthenticatedSessionController::class,'showLoginForm']);

Route::post('/login',[AuthenticatedSessionController::class,'login'])->name('login');

Route::get('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');

Route::get('/',[AttendanceController::class,'showClockInPage']);

Route::get('/attendance',[AttendanceController::class,'showAttendance']);

Route::post('/attendance-start', [AttendanceController::class, 'attendanceStart'])->name('attendanceStart');

Route::post('/attendance-end', [AttendanceController::class,'attendanceEnd'])->name('attendanceEnd');

Route::post('/break-start', [BreakController::class,'breakStart'])->name('breakStart');

Route::post('/break-end', [BreakController::class,'breakEnd'])->name('breakEnd');