<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// laikina – vėliau pakeisiu į tikrus kontrolerius
Route::get('/client', function () {
    return view('placeholder', ['pageTitle' => __('messages.client_subsystem')]);
})->name('client.index');

Route::get('/employee', function () {
    return view('placeholder', ['pageTitle' => __('messages.employee_subsystem')]);
})->name('employee.index');

Route::get('/admin', function () {
    return view('placeholder', ['pageTitle' => __('messages.admin_subsystem')]);
})->name('admin.dashboard');
