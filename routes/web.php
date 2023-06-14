<?php

use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemuanController;
use App\Http\Controllers\LembarTemuanController;
use App\Http\Controllers\TindakLanjutController;
use App\Models\Temuan;
use App\Models\User;

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
    return redirect('/login');
});


$role = '';
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])
->group(function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.',], function() {
        Route::get('', [JobApplicationController::class, 'index'])->name('index');
        Route::get('{id}', [JobApplicationController::class, 'show'])->name('show');
        Route::delete('{id}', [JobApplicationController::class, 'destroy'])->name('destroy');
        Route::post('dataTable', [JobApplicationController::class, 'dataTable'])->name('dashboard.dataTable');
    });
});
