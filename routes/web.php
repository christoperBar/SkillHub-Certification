<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructorController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('participants', ParticipantController::class);
Route::resource('kelas', KelasController::class);
Route::resource('instructors', InstructorController::class);

Route::get('/registrations/filter', [RegistrationController::class, 'filter'])
    ->name('registrations.filter');
Route::resource('registrations', RegistrationController::class);
