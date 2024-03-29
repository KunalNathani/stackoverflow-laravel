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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('questions', \App\Http\Controllers\QuestionsController::class)->except('show');
Route::get('questions/{slug}', [\App\Http\Controllers\QuestionsController::class, 'show'])->name('single-question');
Route::put('questions/{question}/answers/{answer}/best-answer', [\App\Http\Controllers\QuestionAnswerController::class, 'markAsBest'])->name('markAsBest');
Route::get('questions/{question}/answers/{answer}/edit', [\App\Http\Controllers\QuestionAnswerController::class, 'edit'])->name('edit-question');
Route::resource('answers', \App\Http\Controllers\AnswersController::class)->except('edit');
Route::post('questions/{question}/favorite', [\App\Http\Controllers\FavoritesController::class, 'store'])->name('questions.favorite');
Route::delete('questions/{question}/unfavorite', [\App\Http\Controllers\FavoritesController::class, 'destroy'])->name('questions.unfavorite');
Route::post('questions/{question}/vote/{vote}', [\App\Http\Controllers\VotesController::class, 'voteQuestion'])->name('questions.vote');
Route::post('answers/{answer}/vote/{vote}', [\App\Http\Controllers\VotesController::class, 'voteAnswer'])->name('answers.vote');
Route::get('/users/notifications', [\App\Http\Controllers\UsersController::class, 'notifications'])->name('users.notifications');
Route::put('/users/notifications/all-notifications-read', [\App\Http\Controllers\UsersController::class, 'markAllAsRead'])->name('users.markAllNotificationAsRead');
Route::put('/users/notifications/{notification}', [\App\Http\Controllers\UsersController::class, 'markAsRead'])->name('users.markNotificationAsRead');
require __DIR__.'/auth.php';
