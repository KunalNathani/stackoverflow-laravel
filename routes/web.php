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
Route::get('questions/{slug}', [\App\Http\Controllers\QuestionsController::class, 'show']);
Route::put('questions/{question}/answers/{answer}/best-answer', [\App\Http\Controllers\QuestionAnswerController::class, 'markAsBest'])->name('markAsBest');
require __DIR__.'/auth.php';
