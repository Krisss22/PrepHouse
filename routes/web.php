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

Route::group(['prefix' => 'landing'], function () {
    Route::get('/{landingName}', [App\Http\Controllers\Landing\LandingsController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'notifications'], function () {
    Route::get('/getAllNotifications', [App\Http\Controllers\Notification\NotificationController::class, 'getAllNotifications'])->name('getAllNotifications');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'study'], function () {
    Route::get('/', [App\Http\Controllers\Study\StudyController::class, 'index'])->name('study');
    Route::get('/topic-materials/{topicId}', [App\Http\Controllers\Study\StudyController::class, 'topicMaterialsList'])->name('topic-materials');
    Route::get('/videos/{topicId}', [App\Http\Controllers\Study\StudyController::class, 'videosList'])->name('videos');
    Route::get('/books/{topicId}', [App\Http\Controllers\Study\StudyController::class, 'booksList'])->name('books');
    Route::get('/materials/{topicId}', [App\Http\Controllers\Study\StudyController::class, 'materialsList'])->name('materials');
    Route::get('/sites/{topicId}', [App\Http\Controllers\Study\StudyController::class, 'sitesList'])->name('sites');
});

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

Route::group(['prefix' => 'interview-requests'], function () {
    Route::post('/save', [App\Http\Controllers\InterviewRequest\InterviewRequestController::class, 'saveInterviewRequest'])->name('save-interview-request');
});

// -------------------- Admin routs --------------------
Route::group(['prefix' => 'admin'], function () {
    Route::any('/', [App\Http\Controllers\Admin\StatisticController::class, 'index']);
});

Route::group(['prefix' => 'admin/interview-requests'], function () {
    Route::any('/', [App\Http\Controllers\Admin\InterviewRequestController::class, 'index']);
    Route::any('/delete/{interviewRequestId}', [App\Http\Controllers\Admin\InterviewRequestController::class, 'delete']);
    Route::any('/change-status/{interviewRequestId}/{newStatus}', [App\Http\Controllers\Admin\InterviewRequestController::class, 'changeStatus']);
});

Route::group(['prefix' => 'admin/statistics'], function () {
    Route::any('list', [App\Http\Controllers\Admin\StatisticController::class, 'index']);
});

Route::group(['prefix' => 'admin/common'], function () {
    Route::get('/', [App\Http\Controllers\Admin\CommonController::class, 'index']);
});

Route::group(['prefix' => 'admin/study'], function () {
    Route::get('list', [App\Http\Controllers\Admin\StudyController::class, 'index']);

    Route::get('list/{topicId}/videos', [App\Http\Controllers\Admin\StudyController::class, 'videos'])->name('admin-study-videos');
    Route::any('list/{topicId}/video/create', [App\Http\Controllers\Admin\StudyController::class, 'createVideo'])->name('admin-study-create-video');
    Route::any('list/video/{videoId}/edit', [App\Http\Controllers\Admin\StudyController::class, 'editVideo'])->name('admin-study-edit-video');
    Route::get('list/video/{videoId}/remove', [App\Http\Controllers\Admin\StudyController::class, 'deleteVideo'])->name('admin-study-remove-video');

    Route::get('list/{topicId}/books', [App\Http\Controllers\Admin\StudyController::class, 'books'])->name('admin-study-books');
    Route::any('list/{topicId}/book/create', [App\Http\Controllers\Admin\StudyController::class, 'createBook'])->name('admin-study-create-book');
    Route::any('list/book/{videoId}/edit', [App\Http\Controllers\Admin\StudyController::class, 'editBook'])->name('admin-study-edit-book');
    Route::get('list/book/{videoId}/remove', [App\Http\Controllers\Admin\StudyController::class, 'deleteBook'])->name('admin-study-remove-book');

    Route::get('list/{topicId}/materials', [App\Http\Controllers\Admin\StudyController::class, 'materials'])->name('admin-study-materials');
    Route::any('list/{topicId}/material/create', [App\Http\Controllers\Admin\StudyController::class, 'createMaterial'])->name('admin-study-create-material');
    Route::any('list/material/{videoId}/edit', [App\Http\Controllers\Admin\StudyController::class, 'editMaterial'])->name('admin-study-edit-material');
    Route::get('list/material/{videoId}/remove', [App\Http\Controllers\Admin\StudyController::class, 'deleteMaterial'])->name('admin-study-remove-material');

    Route::get('list/{topicId}/sites', [App\Http\Controllers\Admin\StudyController::class, 'sites'])->name('admin-study-sites');
    Route::any('list/{topicId}/site/create', [App\Http\Controllers\Admin\StudyController::class, 'createSite'])->name('admin-study-create-site');
    Route::any('list/site/{videoId}/edit', [App\Http\Controllers\Admin\StudyController::class, 'editSite'])->name('admin-study-edit-site');
    Route::get('list/site/{videoId}/remove', [App\Http\Controllers\Admin\StudyController::class, 'deleteSite'])->name('admin-study-remove-site');

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
    Route::any('create', [App\Http\Controllers\Admin\UserController::class, 'create']);
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

Route::group(['prefix' => 'admin/expertise-areas'], function () {
    Route::get('list', [App\Http\Controllers\Admin\ExpertiseAreaController::class, 'index']);
    Route::any('create', [App\Http\Controllers\Admin\ExpertiseAreaController::class, 'create']);
    Route::any('change-status/{expertiseAreaId}/{newStatus}', [App\Http\Controllers\Admin\ExpertiseAreaController::class, 'changeStatus']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\ExpertiseAreaController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\ExpertiseAreaController::class, 'delete']);
    Route::get('get-json', [App\Http\Controllers\Admin\ExpertiseAreaController::class, 'getJson']);
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

Route::group(['prefix' => 'admin/roles'], function () {
    Route::get('list', [App\Http\Controllers\Admin\RolesController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\Admin\RolesController::class, 'show']);
    Route::any('create', [App\Http\Controllers\Admin\RolesController::class, 'create']);
    Route::any('edit/{id}', [App\Http\Controllers\Admin\RolesController::class, 'edit']);
    Route::get('delete/{id}', [App\Http\Controllers\Admin\RolesController::class, 'delete']);
});

Route::group(['prefix' => 'admin/landings'], function () {
    Route::get('list', [App\Http\Controllers\Admin\LandingsController::class, 'index']);
    Route::any('create', [App\Http\Controllers\Admin\LandingsController::class, 'create']);
    Route::any('edit/{landingsId}', [App\Http\Controllers\Admin\LandingsController::class, 'edit']);
    Route::get('delete/{landingsId}', [App\Http\Controllers\Admin\LandingsController::class, 'delete']);
    Route::get('changeActive/{landingsId}/{condition}', [App\Http\Controllers\Admin\LandingsController::class, 'changeActive']);
});

Auth::routes();
