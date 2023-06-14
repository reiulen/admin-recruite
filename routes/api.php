<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\RequestBrosurController;
use App\Http\Controllers\CounterSectionController;
use App\Http\Controllers\JobApplicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'job-application', 'as' => 'job.', 'middleware' => 'apiMiddleware'], function() {
    Route::post('/', [JobApplicationController::class, 'store'])->name('store');
});


