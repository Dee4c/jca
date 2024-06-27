<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserManagementController;

// Home Routes
Route::redirect('/', '/login'); 
Route::get('/login', [UserAuthenticationController::class, 'login'])->name('alreadyLoggedIn');
Route::post('login-user', [UserAuthenticationController::class, 'loginUser'])->name('login-user');
Route::get('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');

// User Management Routes
Route::middleware(['isLoggedIn'])->group(function () {
    Route::get('/usermanage/dashboard', [UserManagementController::class, 'dashboard'])->name('usermanage.dashboard');
    Route::get('/usermanage/addjudge', [UserManagementController::class, 'addJudgeForm'])->name('addJudgeForm');
    Route::post('/usermanage/addjudge', [UserManagementController::class, 'addJudge'])->name('addJudge');
    Route::put('/user/{id}', [UserManagementController::class, 'updateUser'])->name('user.update');
    Route::delete('/user/{id}', [UserManagementController::class, 'deleteUser'])->name('user.delete');
    
    // Candidate Management Routes
    Route::get('/candidates/create', [UserManagementController::class, 'createCandidate'])->name('candidate.create');
    Route::post('/candidates', [UserManagementController::class, 'storeCandidate'])->name('candidate.store');
    Route::get('/usermanage/candidate_dash', [UserManagementController::class, 'candidateDash'])->name('usermanage.candidate_dash');
    Route::put('/candidates/{id}', [UserManagementController::class, 'updateCandidate'])->name('candidate.update');
    Route::delete('/candidates/{id}', [UserManagementController::class, 'deleteCandidate'])->name('candidate.delete');

    // Preliminary Management Routes
    Route::get('/usermanage/preliminary_dash', [UserManagementController::class, 'preliminaryDash'])->name('usermanage.preliminary_dash');
    // Semi-Final Management Routes
    Route::get('/usermanage/semi_final_dash', [UserManagementController::class, 'SemiFinalDash'])->name('usermanage.semi_final_dash');
    Route::post('/insert-semi-finalists', [UserManagementController::class, 'insertSemiFinalists'])->name('insertSemiFinalists');
    
    // Final Management Routes
    Route::post('/insert-finalists', [UserManagementController::class, 'insertFinalists'])->name('insertFinalists');
    Route::get('/usermanage/final_dash', [UserManagementController::class, 'FinalDash'])->name('usermanage.final_dash');

    // Judge Dashboard Routes
    Route::get('/judge/judgeDashboard', [UserManagementController::class, 'judgeDashboard'])->name('judge.judge_dashboard');
    Route::get('/judge/semifinalsDashboard', [UserManagementController::class, 'semifinalsDashboard'])->name('judge.semi_finals_dash');
    Route::get('/judge/swim-suit-table', [UserManagementController::class, 'swimSuitTable'])->name('judge.swim_suit_table');
    Route::get('/judge/edit_score', [UserManagementController::class, 'EditScoreDash'])->name('judge.edit_score');
    Route::get('/judge/gown-table', [UserManagementController::class, 'gownTable'])->name('judge.gown_table');
    Route::get('/judge/finalsDashboard', [UserManagementController::class, 'finalsDashboard'])->name('judge.finals_dash');

    // Scores Routes
    Route::post('/pre-interview-scores', [UserManagementController::class, 'storePreInterviewScore'])->name('pre-interview-scores.store');
    Route::post('/swim-suit-scores', [UserManagementController::class, 'storeSwimSuitScore'])->name('swim-suit-scores.store');
    Route::post('gown-scores', [UserManagementController::class, 'storeGownScore'])->name('gown-scores.store');
    Route::get('/pre-interview-scores', [UserManagementController::class, 'getPreInterviewScores']);
    Route::post('/semi-final-scores', [UserManagementController::class, 'storeSemiFinalScore'])->name('semi-final-scores.store');
    Route::post('/final-scores', [UserManagementController::class, 'storeFinalScore'])->name('final-scores.store');
});