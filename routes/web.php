<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserManagementController;

Route::redirect('/', '/login'); 
Route::get('/login', [UserAuthenticationController::class, 'login'])->name('alreadyLoggedIn');
Route::post('login-user', [UserAuthenticationController::class, 'loginUser'])->name('login-user');
Route::get('/usermanage/dashboard', [UserAuthenticationController::class, 'dashboard'])->middleware('isLoggedIn')->name('usermanage.dashboard');
Route::get('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');
Route::get('/usermanage/addjudge', [UserManagementController::class, 'addJudgeForm'])->middleware('isLoggedIn')->name('addJudgeForm');
Route::post('/usermanage/addjudge', [UserManagementController::class, 'addJudge'])->middleware('isLoggedIn')->name('addJudge');
Route::delete('/user/{id}', [UserManagementController::class, 'deleteUser'])->name('user.delete');
Route::put('/user/{id}', [UserManagementController::class, 'updateUser'])->middleware('isLoggedIn')->name('user.update');
Route::post('/candidates', [UserManagementController::class, 'storeCandidate'])->middleware('isLoggedIn')->name('candidate.store');
Route::get('/candidates/create', [UserManagementController::class, 'createCandidate'])->middleware('isLoggedIn')->name('candidate.create');
Route::get('/usermanage/candidate_dash', [UserManagementController::class, 'candidateDash'])->middleware('isLoggedIn')->name('usermanage.candidate_dash');
Route::delete('/candidates/{id}', [UserManagementController::class, 'deleteCandidate'])->middleware('isLoggedIn')->name('candidate.delete');
Route::put('/candidates/{id}', [UserManagementController::class, 'updateCandidate'])->middleware('isLoggedIn')->name('candidate.update');
Route::get('/usermanage/preliminary_dash', [UserManagementController::class, 'preliminaryDash'])->name('usermanage.preliminary_dash');
Route::get('/usermanage/prelim_swimsuit_dash', [UserManagementController::class, 'preliminarySwimSuitDash'])->name('usermanage.prelim_swimsuit_dash');
Route::get('/usermanage/prelim_gown_dash', [UserManagementController::class, 'preliminaryGownDash'])->name('usermanage.prelim_gown_dash');
Route::get('/usermanage/prelim_overall_ranks', [UserManagementController::class, 'preliminaryOverallRanksDash'])->name('usermanage.prelim_overall_ranks_dash');
Route::get('/judge/judgeDashboard', [UserManagementController::class, 'judgeDashboard'])->middleware('isLoggedIn')->name('judge.judge_dashboard');
Route::get('/pre-interview-scores', [UserManagementController::class, 'getPreInterviewScores']);
Route::get('/judge/semifinalsDashboard', [UserManagementController::class, 'semifinalsDashboard'])->middleware('isLoggedIn')->name('judge.semi_finals_dash');
Route::post('/pre-interview-scores', [UserManagementController::class, 'storePreInterviewScore'])->middleware('isLoggedIn')->name('pre-interview-scores.store');
Route::post('/swim-suit-scores', [UserManagementController::class,'storeSwimSuitScore'])->middleware('isLoggedIn')->name('swim-suit-scores.store');
Route::post('gown-scores', [UserManagementController::class, 'storeGownScore'])->middleware('isLoggedIn')->name('gown-scores.store');
Route::get('/swim-suit-table', [UserManagementController::class, 'swimSuitTable'])->middleware('isLoggedIn')->name('swim-suit-table');
Route::get('/gown-table', [UserManagementController::class, 'gownTable'])->middleware('isLoggedIn')->name('gown-table');
Route::post('/usermanage/preliminary_overall_ranks', [UserManagementController::class, 'storePreliminaryOverallRanks'])->name('usermanage.preliminary_overall_ranks.store');
Route::post('/usermanage/swimsuit_overall_ranks', [UserManagementController::class, 'storeSwimSuitOverallRanks'])->name('usermanage.swimsuit_overall_ranks.store');
Route::post('/usermanage/gown_overall_ranks', [UserManagementController::class, 'storeGownOverallRanks'])->name('usermanage.gown_overall_ranks.store');
Route::get('/usermanage/semi_final_dash', [UserManagementController::class,'SemiFinalDash'])->middleware('isLoggedIn')->name('usermanage.semi_final_dash');




















