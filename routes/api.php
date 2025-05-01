<?php

// Admin routes
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\InterviewerController;
use App\Http\Controllers\InterviewSchedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StatusUpdateController;
use Illuminate\Support\Facades\Route;


Route::apiResource('admins', AdminController::class);
Route::apiResource('applicants', ApplicantController::class);
Route::apiResource('interviewers', InterviewerController::class);
Route::apiResource('interview-scheds', InterviewSchedController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('results', ResultController::class);
Route::apiResource('status-updates', StatusUpdateController::class);
