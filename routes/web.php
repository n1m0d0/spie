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
    return view('auth.login');
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
    Route::get('type', 'type')->name('page.type')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']); 
    Route::get('measure', 'measure')->name('page.measure')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('pillar', 'pillar')->name('page.pillar')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('sector', 'sector')->name('page.sector')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('hub', 'hub')->name('page.hub')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('result', 'result')->name('page.result')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('goal', 'goal')->name('page.goal')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('action', 'action')->name('page.action')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('dissociation', 'dissociation')->name('page.dissociation')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);    
    Route::get('planning', 'planning')->name('page.planning')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('indicator/{planning}', 'indicator')->name('page.indicator')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('schedule/{indicator}', 'schedule')->name('page.schedule')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('department', 'department')->name('page.department')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('municipality', 'municipality')->name('page.municipality')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('district', 'district')->name('page.district')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('territory/{planning}', 'territory')->name('page.territory')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('finance/{planning}', 'finance')->name('page.finance')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('organization', 'organization')->name('page.organization')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('investment/{finance}', 'investment')->name('page.investment')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('current/{finance}', 'current')->name('page.current')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('consolidated/{finance}', 'consolidated')->name('page.consolidated')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
});