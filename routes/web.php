<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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
// USERS
Route::get('/', [UserController::class, 'index']);
Route::post('/gnetot-upload', [UserController::class, 'gnetotUpload'])->name('gnetot-upload');


// ADMIN
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/login/process', [LoginController::class, 'loginProcess'])->name('loginProcess');

Route::get('/get_player_count', [AdminController::class, 'getPlayerCount']);