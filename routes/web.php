<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/send-question', [App\Http\Controllers\HomeController::class, 'saveQuestion']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('questions/list', [App\Http\Controllers\Admin\QuestionsBankController::class, 'index']);
    Route::get('questions/show/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'show']);
    Route::get('questions/delete/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'delete']);
});

Auth::routes();
