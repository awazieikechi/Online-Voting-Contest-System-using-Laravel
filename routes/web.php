<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
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

Route::get('/', [UserController::class, 'showContest']);
Route::get('/logout', [UserController::class, 'destroy'])->name('user.logout');
Route::get('/send/email', [UserController::class, 'mail']);
Route::get('/rules', [UserController::class, 'showRule']);
Route::post('/vote', [VoteController::class, 'vote']);

Route::get('/test', [VoteController::class, 'testCountPosts']);
Route::get('/auth', [VoteController::class, 'authTest']);


Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'showContest']);
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('show.dashboard');
    Route::get('/dashboard/users', [UserController::class, 'showVoters']);
});
