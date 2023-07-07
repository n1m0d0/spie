<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Models\Action;
use App\Models\Result;
use App\Models\User;

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
    Route::get('user', 'user')->name('page.user')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('type', 'type')->name('page.type')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('entity', 'entity')->name('page.entity')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('measure', 'measure')->name('page.measure')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('pillar', 'pillar')->name('page.pillar')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('sector', 'sector')->name('page.sector')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('hub', 'hub')->name('page.hub')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('result', 'result')->name('page.result')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('goal', 'goal')->name('page.goal')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('action', 'action')->name('page.action')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('dissociation', 'dissociation')->name('page.dissociation')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('planning', 'planning')->name('page.planning')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('indicator/{planning}', 'indicator')->name('page.indicator')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('schedule/{indicator}', 'schedule')->name('page.schedule')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('department', 'department')->name('page.department')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('municipality', 'municipality')->name('page.municipality')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('district', 'district')->name('page.district')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('territory/{planning}', 'territory')->name('page.territory')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('finance/{planning}', 'finance')->name('page.finance')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('organization', 'organization')->name('page.organization')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('investment/{finance}', 'investment')->name('page.investment')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('current/{finance}', 'current')->name('page.current')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('consolidated/{finance}', 'consolidated')->name('page.consolidated')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('report', 'report')->name('page.report')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('frequency/{indicator}', 'frequency')->name('page.frequency')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('approach', 'approach')->name('page.approach')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('diagnostic/{approach}', 'diagnostic')->name('page.diagnostic')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('record/{diagnostic}', 'record')->name('page.record')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('verify', 'verify')->name('page.verify')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:validador']);
    Route::get('show/{planning}', 'show')->name('page.show')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:validador']);    
    Route::get('show-indicator/{planning}', 'showIndicator')->name('page.showIndicator')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:validador']);
    Route::get('observation/{planning}', 'observation')->name('page.observation')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:validador']);
    Route::get('show-observation/{planning}', 'showObservation')->name('page.showObservation')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('pmdi', 'pmdi')->name('page.pmdi')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('indicatorMatch', 'indicatorMatch')->name('page.indicatorMatch')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
    Route::get('objective', 'objective')->name('page.objective')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('aim', 'aim')->name('page.aim')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('pointer', 'pointer')->name('page.pointer')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin']);
    Route::get('articulate/{indicator}', 'articulate')->name('page.articulate')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:creador|creador territorial']);
});

Route::get('util', function () {
    $results = Result::all();
    foreach ($results as $result) {
        $necessary = true;
        foreach ($result->actions as $action) {
            if ($action->name == "-") {
                $necessary = false;
            }
        }

        if ($necessary) {
            $action = new Action();
            $action->name = "-";
            $action->description = "-";
            $action->result_id = $result->id;
            $action->save();
        }
    }

    for ($i = 49; $i <= 400; $i++)
    {
        $user = User::find($i);
        $user->removeRole($user->getRoleNames()[0]);
        $user->assignRole('creador territorial');
    }

    return view('dashboard');
});
