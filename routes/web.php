<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
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
    return view('dashboard');
})->middleware(['auth', 'web'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'web'])->name('dashboard');
Route::get('/report', function () {
    return view('report');
})->middleware(['auth', 'web'])->name('report');



Route::get('/dashboard/index', [DashboardController::class, 'index'])->middleware(['auth','web']);
Route::post('/dashboard/save-spends', [DashboardController::class, 'saveSpends'])->middleware(['auth','web']);
Route::get('/dashboard/spends-names/{name}', [DashboardController::class, 'getSpendsNames'])->middleware(['auth','web']);
Route::get('/report/list', [ReportController::class, 'list'])->middleware(['auth','web']);
Route::get('/report/item/{id}', [ReportController::class, 'getSpendsRecord'])->middleware(['auth','web']);
Route::put('/report/update/{id}', [ReportController::class, 'update'])->middleware(['auth','web']);
Route::delete('/report/delete/{id}', [ReportController::class, 'delete'])->middleware(['auth','web']);
require __DIR__.'/auth.php';
