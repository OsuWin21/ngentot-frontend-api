<?php

use App\Http\Controllers\AdminController;
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

// Route::post('/gnetot-upload', [UserController::class, 'gnetotUpload'])->name('gnetot-upload');
Route::middleware(['web'])->group(function () {
    Route::get('/login', [UserController::class, 'login']);
    Route::post('/login/process', [UserController::class, 'loginProcess'])->name('loginProcess');
});

Route::get('/u/{id}', [UserController::class, 'profile'])->name('profile');
Route::get('/u/edit/{id}', [UserController::class, 'editProfile'])->name('editProfile');
Route::post('/u/edit/process/{id}', [UserController::class, 'editProcess'])->name('editProcess');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// Route::get('/register', [UserController::class, 'register']); WIP

// ADMIN(WIP)
// Route::get('/admin/dashboard', [AdminController::class, 'index']);
// Route::get('/admin/login', [AdminController::class, 'adminLogin']);
// Route::post('/admin/login/process', [AdminController::class, 'adminLoginProcess'])->name('adminLoginProcess');
// Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('adminLogout');
