<?php

use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/speaker/dashboard', [SpeakerController::class, 'dashboard']);
Route::get('/speaker/add-talk-proposal', [SpeakerController::class, 'showNewTalkProposalForm']);
Route::post('/speaker/add-talk-proposal', [SpeakerController::class, 'addTalkProposal'])->name('addTalkProposal');

Route::get('/reviewer/dashboard', [ReviewerController::class, 'dashboard']);
Route::get('/review/{talkProposal}', [ReviewerController::class, 'showReviewForm']);
Route::post('/review/{talkProposal}', [ReviewerController::class, 'addReview'])->name('talkProposalReview');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/login', [LoginController::class, 'index']);
