<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('customer', CustomerController::class)->middleware(['auth', 'verified']);
Route::get('customer/{customer_id}/restore', [CustomerController::class, 'restore'])->middleware(['auth', 'verified'])->name('customer.restore');
Route::get('customer/{search}/city', [CustomerController::class, 'city'])->middleware(['auth', 'verified'])->name('customer.city');
Route::get('customer/{search}/zipcode', [CustomerController::class, 'zipcode'])->middleware(['auth', 'verified'])->name('customer.zipcode');

Route::get('archive', [ArchiveController::class, 'index'])->middleware(['auth', 'verified'])->name('archive.index');

Route::get('logs', [LogController::class, 'index'])->middleware(['auth', 'verified'])->name('logs.index');


require __DIR__ . '/auth.php';
