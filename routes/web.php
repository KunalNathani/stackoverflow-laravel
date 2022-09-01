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
require __DIR__.'/auth.php';
