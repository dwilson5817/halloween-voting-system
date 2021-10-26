<?php

use App\Http\Controllers\ResultsController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

Route::get('/vote', [VoteController::class, 'create'])
    ->name('vote.form');

Route::post('/vote', [VoteController::class, 'store'])
    ->name('vote.submit');

Route::get('/results', [ResultsController::class, 'create'])
    ->name('results');
