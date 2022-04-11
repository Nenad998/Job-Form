<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SoftDeleteController;
use App\Http\Controllers\SubmitFormController;
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/submit', [SubmitFormController::class, 'submit'])->name('submitForm');
Route::get('/appDetails', [SubmitFormController::class, 'showAppDetails'])->name('appDetails')->middleware('auth');

Route::middleware(['admin', 'auth'])->group(function (){
    Route::get('/index', [AdminController::class, 'index'])->name('admin.home');
    Route::put('/approve', [SubmitFormController::class, 'approve'])->name('approve');
    Route::put('/deny', [SubmitFormController::class, 'deny'])->name('deny');
    Route::delete('/softDelete/{id}', [SubmitFormController::class, 'delete'])->name('softDelete');
    Route::get('/search', [SubmitFormController::class, 'search'])->name('search');

    Route::get('/deletedApps', [SoftDeleteController::class, 'deletedApps'])->name('deletedApps');
    Route::get('/restore/{id}', [SoftDeleteController::class, 'restore'])->name('restore');
    Route::delete('/delete/{id}', [SoftDeleteController::class, 'delete'])->name('delete');
});

Route::get('/', function () {
    return view('welcome');
})->name('/');
