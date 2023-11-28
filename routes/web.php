<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectHolderController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
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

Route::group(['prefix' => 'login'], function() {
    Route::get('/', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');

    Route::resource('/administrators',AdministratorController::class);
    Route::resource('/project-holders', ProjectHolderController::class);
    Route::resource('/employees', EmployeeController::class);

    Route::resource('/projects',ProjectController::class );
    Route::resource('/comments',CommentController::class);
    Route::resource('/tasks',TaskController::class);
    Route::resource('/statuses',StatusController::class);
    Route::resource('/resources',ResourceController::class);
});
