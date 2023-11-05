<?php

use App\Http\Controllers\AuthorContributorController;
use App\Http\Controllers\AuthorContributorRuleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaperSubmissionController;
use App\Http\Controllers\SubmissionFileController;
use App\Http\Controllers\SubmissionFileTypeController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.welcome');
    })->name('home');

    Route::prefix('submission')->controller(PaperSubmissionController::class)->group(function () {
        Route::get('step1', 'submission_1')->name('submission_step_1');
        Route::post('step1', 'submission_1_req')->name('submission_step_1_req');
        Route::get('step2', 'submission_2')->name('submission_step_2');
        Route::post('step2', 'submission_2_req')->name('submission_step_2_req');
        Route::get('step3', 'submission_3')->name('submission_step_3');
        Route::post('step3', 'submission_3_req')->name('submission_step_3_req');
        Route::get('step4', 'submission_4')->name('submission_step_4');
        Route::post('step4', 'submission_4_req')->name('submission_step_4_req');

        Route::get('view-paper/{id}', 'view_paper_detail')->name('view_paper_detail');
        Route::get('view/{in_draft?}', 'my_submission')->name('my_submission');
        Route::get('continue-draft/{id}', 'continue_draft')->name('continue_draft');


        Route::get('all_submissions', 'all_submissions_page')->name('all_submissions_page');
    });


    Route::prefix('contributor')->controller(AuthorContributorController::class)->group(function () {
        Route::post('add', 'add_contributor')->name('add_contributor');
        Route::get('delete/{id}', 'delete_contributor')->name('delete_contributor');
    });

    Route::prefix('contributor-rule')->controller(AuthorContributorRuleController::class)->group(function () {
        Route::get('view', 'view')->name('contributor_rule_page');
        Route::post('add', 'add')->name('add_contributor_rule');
    });

    Route::prefix('file-type')->controller(SubmissionFileTypeController::class)->group(function () {
        Route::get('view', 'view')->name('file_type_page');
        Route::post('add', 'add')->name('add_file_type');
    });

    Route::prefix('file')->controller(SubmissionFileController::class)->group(function () {
        Route::post('upload', 'upload_file')->name('upload_file');
        Route::get('delete/{id}', 'delete_file')->name('delete_file');
    });

    Route::prefix('author')->controller(UserController::class)->group(function () {
        Route::get('view', 'view_author')->name('view_author_page');
        Route::get('add', 'add_author_page')->name('add_author_page');
        Route::post('add', 'add_author_req')->name('add_author_req');
    });
});


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login_page')->name('login');
    Route::post('login', 'login_req')->name('login_req');
    Route::get('register', 'register_page')->name('register');
    Route::post('register', 'register_req')->name('register_req');

    Route::get('logout', 'logout')->name('logout');
});
