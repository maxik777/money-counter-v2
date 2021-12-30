<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'web'])->name('dashboard');
Route::get('/report', function () {
    return view('report');
})->middleware(['auth', 'web'])->name('report');

Route::get('/dashboard/index', [DashboardController::class, 'index'])->middleware(['auth','web']);
Route::post('/dashboard/save-spends', [DashboardController::class, 'saveSpends'])->middleware(['auth','web']);
require __DIR__.'/auth.php';
