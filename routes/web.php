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
Route::any('/share-question', [App\Http\Controllers\HomeController::class, 'shareQuestion'])->name('share-question');

Route::get('/strategies', [App\Http\Controllers\Strategies\StrategiesController::class, 'index'])->name('strategies');

Route::get('/study', [App\Http\Controllers\Study\StudyController::class, 'index'])->name('study');

Route::any('/quizzes-list', [App\Http\Controllers\Quiz\QuizzesController::class, 'index'])->name('quizzes-list');
Route::get('/quiz/run/{quizId}', [App\Http\Controllers\Quiz\QuizzesController::class, 'runQuiz'])->name('quiz-run');
Route::get('/quiz/{quizActionId}', [App\Http\Controllers\Quiz\QuizzesController::class, 'processQuiz'])->name('quiz-process');
Route::post('/quiz/answerProcess/{quizActionId}', [App\Http\Controllers\Quiz\QuizzesController::class, 'answerProcess'])->name('quiz-answer-process');
Route::get('/quiz/getQuestion/{quizActionId}/{questionId}', [App\Http\Controllers\Quiz\QuizzesController::class, 'getQuestion'])->name('quiz-get-question');
Route::get('/quiz/finish/{quizActionId}', [App\Http\Controllers\Quiz\QuizzesController::class, 'finish'])->name('quiz-finish');
Route::get('/quiz/statistic/list', [App\Http\Controllers\Quiz\QuizzesController::class, 'statisticList'])->name('quiz-statistic-list');
Route::get('/quiz/statistic/{quizActionId}', [App\Http\Controllers\Quiz\QuizzesController::class, 'statistic'])->name('quiz-statistic');

Route::group(['prefix' => 'account'], function () {
    Route::any('/', [App\Http\Controllers\Account\AccountController::class, 'index'])->name('account');
    Route::get('/profile', [App\Http\Controllers\Account\AccountController::class, 'profile'])->name('account-profile');
    Route::post('/profile/save', [App\Http\Controllers\Account\AccountController::class, 'profileSave'])->name('account-profile-save');
    Route::get('/password', [App\Http\Controllers\Account\AccountController::class, 'password'])->name('account-password');
    Route::post('/password/save', [App\Http\Controllers\Account\AccountController::class, 'passwordSave'])->name('account-password-save');
    Route::get('/notifications', [App\Http\Controllers\Account\AccountController::class, 'notifications'])->name('account-notifications');
    Route::post('/notifications/save', [App\Http\Controllers\Account\AccountController::class, 'notificationsSave'])->name('account-notifications-save');
});

// Admin routs
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

Route::group(['prefix' => 'admin/sent-questions'], function () {
    Route::any('list', [App\Http\Controllers\Admin\SentQuestionController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\SentQuestionController::class, 'show']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\SentQuestionController::class, 'delete']);
    Route::get('move/{id}', [App\Http\Controllers\Admin\SentQuestionController::class, 'move']);
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
    Route::get('get-json', [App\Http\Controllers\Admin\TagController::class, 'getJson']);
});

Route::group(['prefix' => 'admin/topics'], function () {
    Route::get('list', [App\Http\Controllers\Admin\TopicController::class, 'index']);
    Route::any('create', [App\Http\Controllers\Admin\TopicController::class, 'create']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\TopicController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\TopicController::class, 'delete']);
    Route::get('get-json', [App\Http\Controllers\Admin\TopicController::class, 'getJson']);
});

Route::group(['prefix' => 'admin/quizzes'], function () {
    Route::get('list', [App\Http\Controllers\Admin\QuizController::class, 'index']);
    Route::any('create', [App\Http\Controllers\Admin\QuizController::class, 'create']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\QuizController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\QuizController::class, 'delete']);
});

Auth::routes();
