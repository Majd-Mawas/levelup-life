<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// Route::middleware('auth')->group(function () {
Route::middleware([])->group(function () {
    // Coach dashboard
    Route::get('/dashboard', function () {
        return view('coach.dashboard');
    })->name('dashboard');

    // Exercise management
    Route::resource('exercises', ExerciseController::class);

    // Trainee management
    Route::resource('trainees', TraineeController::class);

    // Program management
    Route::resource('programs', ProgramController::class);
    Route::get('programs/{program}/pdf', [ProgramController::class, 'generatePdf'])->name('programs.pdf');
    Route::get('programs/{program}/pdf/stream', [ProgramController::class, 'streamPdf'])->name('programs.pdf.stream');

    // Day management
    Route::resource('days', DayController::class);
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('/home', fn() => view('index'))->name('home');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
