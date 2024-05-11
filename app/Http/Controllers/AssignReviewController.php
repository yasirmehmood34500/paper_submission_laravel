<?php

namespace App\Http\Controllers;

use App\Interfaces\AssignReviewInterface;
use App\Interfaces\PaperSubmissionInterface;
use App\Mail\AssignToReviewEmail;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Http\Request;

class AssignReviewController extends Controller
{
	public function __construct(protected AssignReviewInterface $assign_review_interface, protected PaperSubmissionInterface $paper_submission_interface, protected UserRepository $user_interface)
	{
		//
	}
	public function add($user_id, $paper_id)
	{
		$paper = $this->paper_submission_interface->get_by_id($paper_id);
		$this->assign_review_interface->add($user_id, $paper);
		$user = $this->user_interface->single($user_id);
		if ($user && config('app.env') == 'production') {
			try {
				Mail::to($user->email)->send(new AssignToReviewEmail($paper->paper_no, $paper->title, $user->name));
			} catch (\Throwable $th) {
				info($th->getMessage());
			}
		}
		return back();
	}
}
