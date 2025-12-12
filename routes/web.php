<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController; 
use App\Http\Controllers\EmployeeController; 
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DepartmentController; 
use App\Http\Controllers\PositionController; 
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;


// mengarah halaman login dulu
Route::get('/', function () {
    return redirect()->route('login');
});


// hanya user yg boleh akses login
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
});


// hanya user login & verified boleh akses halaman lain
Route::middleware(['auth', 'verified'])->group(function () {

    // Setelah login redirect ke employees
    Route::get('/dashboard', function () {
        return redirect('/employees');
    })->name('dashboard');

    Route::resource('employees', EmployeeController::class);

    // Nested Documents
    Route::resource('employees.documents', DocumentController::class);

    Route::resource('reports', ReportController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('salaries', SalariesController::class);
    Route::resource('attendance', AttendanceController::class);

    // Profile
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
