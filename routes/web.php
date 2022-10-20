<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(PageController::class)->group(function () {
    Route::get('user', 'user')->name('page.user')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('hub', 'hub')->name('page.hub')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('result', 'result')->name('page.result')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('goal', 'goal')->name('page.goal')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('action', 'action')->name('page.action')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('dissociation', 'dissociation')->name('page.dissociation')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('indicator', 'indicator')->name('page.indicator')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
});