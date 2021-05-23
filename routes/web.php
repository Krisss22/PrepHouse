<?php

use Illuminate\Support\Facades\Auth;
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
    Route::any('/', [App\Http\Controllers\Admin\StatisticController::class, 'index']);
});

Route::group(['prefix' => 'admin/statistics'], function () {
    Route::any('list', [App\Http\Controllers\Admin\StatisticController::class, 'index']);
});

Route::group(['prefix' => 'admin/common'], function () {
    Route::get('/', [App\Http\Controllers\Admin\CommonController::class, 'index']);
});

Route::group(['prefix' => 'admin/questions'], function () {
    Route::any('list', [App\Http\Controllers\Admin\QuestionsBankController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'show']);
    Route::any('create', [App\Http\Controllers\Admin\QuestionsBankController::class, 'create']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'delete']);
    Route::get('release/{id}', [App\Http\Controllers\Admin\QuestionsBankController::class, 'release']);
});

Route::group(['prefix' => 'admin/vacancies'], function () {
    Route::get('list', [App\Http\Controllers\Admin\VacancyController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\VacancyController::class, 'show']);
    Route::any('create', [App\Http\Controllers\Admin\VacancyController::class, 'create']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\VacancyController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\VacancyController::class, 'delete']);
});

Route::group(['prefix' => 'admin/users'], function () {
    Route::get('list', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\UserController::class, 'show']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);
});

Route::group(['prefix' => 'admin/tags'], function () {
    Route::get('list', [App\Http\Controllers\Admin\TagController::class, 'index']);
    Route::any('create', [App\Http\Controllers\Admin\TagController::class, 'create']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\TagController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\TagController::class, 'delete']);
});

Auth::routes();
