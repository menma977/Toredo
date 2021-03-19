<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboadController;
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

Route::middleware('guest')->group(function () {
    Route::get('/dashboard', [DashboadController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/show', [DashboadController::class, 'show'])->name('dashboard');
    Route::get('/bank', [BankController::class, 'index'])->name('bank');
});

require __DIR__ . '/auth.php';
