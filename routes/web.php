<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\ReviewTypeController;
use App\Http\Controllers\AssignReviewController;
use App\Http\Controllers\SubmissionFileController;
use App\Http\Controllers\PaperSubmissionController;
use App\Http\Controllers\AuthorContributorController;
use App\Http\Controllers\SubmissionFileTypeController;
use App\Http\Controllers\AuthorContributorRuleController;
use App\Http\Controllers\SubmissionRequirementController;

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

        Route::get('paper-status/{status}', 'paper_status_wise')->name('paper_status_wise');
        Route::get('all_submissions', 'all_submissions_page')->name('all_submissions_page');
        Route::get('assign-paper', 'reviewer_assign_page')->name('reviewer_assign_page');

        Route::post('reply-review', 'reviewer_reply_paper')->name('reviewer_reply_paper');
        Route::post('revision-send-to-author', 'revision_send_to_author')->name('revision_send_to_author');
        Route::post('revision-reply-send', 'revision_reply_send')->name('revision_reply_send');
    });


    Route::prefix('contributor')->controller(AuthorContributorController::class)->group(function () {
        Route::post('add', 'add_contributor')->name('add_contributor');
        Route::get('delete/{id}', 'delete_contributor')->name('delete_contributor');
    });

    Route::prefix('contributor-rule')->controller(AuthorContributorRuleController::class)->group(function () {
        Route::get('view', 'view')->name('contributor_rule_page');
        Route::get('delete/{id}', 'delete')->name('contributor_rule_delete');
        Route::post('add', 'add')->name('add_contributor_rule');
    });

    Route::prefix('review-type')->controller(ReviewTypeController::class)->group(function () {
        Route::get('view', 'view')->name('review_type_page');
        Route::get('delete/{id}', 'delete')->name('review_type_delete');
        Route::post('add', 'add')->name('add_review_type');
    });

    Route::prefix('file-type')->controller(SubmissionFileTypeController::class)->group(function () {
        Route::get('view', 'view')->name('file_type_page');
        Route::get('delete/{id}', 'delete')->name('file_type_delete');
        Route::post('add', 'add')->name('add_file_type');
    });

    Route::prefix('file')->controller(SubmissionFileController::class)->group(function () {
        Route::post('upload', 'upload_file')->name('upload_file');
        Route::post('upload-revision', 'revision_upload_file')->name('revision_upload_file');
        Route::get('delete/{id}', 'delete_file')->name('delete_file');
    });

    Route::prefix('author')->controller(UserController::class)->group(function () {
        Route::get('view', 'view_author')->name('view_author_page');
        Route::get('add', 'add_author_page')->name('add_author_page');
        Route::post('add', 'add_author_req')->name('add_author_req');
        Route::post('search', 'search_reviewer')->name('search_reviewer_req');
    });

    Route::prefix('reviewer')->controller(UserController::class)->group(function () {
        Route::get('view', 'view_reviewer')->name('view_reviewer_page');
        Route::get('add', 'add_reviewer_page')->name('add_reviewer_page');
        Route::post('add', 'add_reviewer_req')->name('add_reviewer_req');
        Route::get('login-as-user/{user_id}', 'login_as_user_link')->name('login_as_user_link');
    });

    Route::prefix('assign-permission')->controller(RoleUserController::class)->group(function () {
        Route::get('view/{user_id}', 'view_user_permission')->name('view_user_permission_page');
        Route::post('add', 'add_user_permission_req')->name('add_user_permission_req');
    });

    Route::prefix('submission-requirement')->controller(SubmissionRequirementController::class)->group(function () {
        Route::get('view', 'view')->name('view_submission_requirement_page');
        Route::get('delete/{id}', 'delete')->name('delete_submission_requirement');
        Route::post('view', 'create')->name('create_submission_requirement');
    });

    Route::prefix('assign-to-reviewer')->controller(AssignReviewController::class)->group(function () {
        Route::get('send/{user_id}/{paper_id}', 'add')->name('send_to_reviewer');
    });

    Route::prefix('profile-setting')->controller(UserController::class)->group(function () {
        Route::get('update-password', 'update_password')->name('update_password');
        Route::post('update-password', 'update_password_req')->name('update_password_req');
    });


    Route::prefix('email-design-view')->group(function () {
        Route::get('{blade_name}', function ($blade_name) {
            return view("pages.email-template." . $blade_name)->with([
                'name' => "SIR",
                "comment" => "Comment",
                "title" => "Paper Title",
                "paper_no" => "Paper No",
            ]);
        });
    });
});


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'login_page')->name('login');
    Route::post('login', 'login_req')->name('login_req');
    Route::get('register', 'register_page')->name('register');
    Route::post('register', 'register_req')->name('register_req');

    Route::get('logout', 'logout')->name('logout');
});
