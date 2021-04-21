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

Route::group(['prefix' => 'admin/common'], function () {
    Route::get('/', [App\Http\Controllers\Admin\CommonController::class, 'index']);
});

Route::group(['prefix' => 'admin/questions'], function () {
    Route::get('list', [App\Http\Controllers\Admin\QuestionsBankController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'show']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'delete']);
});

Route::group(['prefix' => 'admin/users'], function () {
    Route::get('list', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\UserController::class, 'show']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);
});

Auth::routes();
