<?php

use App\Http\Controllers\Sample\IndexController;
use App\Http\Controllers\Tweet\CreateController;
use App\Http\Controllers\Tweet\Update\PutController;
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
    return view('welcome');
});

Route::get('/sample', [IndexController::class, 'show']);
Route::get('/sample/{id}', [IndexController::class, 'showId']);

Route::get('/tweet', \App\Http\Controllers\Tweet\IndexController::class)->name('tweet.index');
Route::post('/tweet/create', CreateController::class)->name('tweet.create');
Route::get('/tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)
    ->name('tweet.update.index');
Route::put('/tweet/update/{tweetId}', PutController::class)->name('tweet.update.put');
