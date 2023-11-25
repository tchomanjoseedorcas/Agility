<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectHolderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'login'], function() {
    Route::get('/', [AuthController::class, 'loginPage'])->name('login.page');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

Route::resource('/administrators',AdministratorController::class);
Route::resource('/project-holders', ProjectHolderController::class);
Route::resource('/employees', EmployeeController::class);
