<?php

namespace App\Http\Controllers;

use App\Interfaces\AssignReviewInterface;
use App\Interfaces\PaperSubmissionInterface;
// use Illuminate\Http\Request;

class AssignReviewController extends Controller
{
	public function __construct(protected AssignReviewInterface $assign_review_interface, protected PaperSubmissionInterface $paper_submission_interface,)
	{
		//
	}
	public function add($user_id, $paper_id)
	{
		$paper = $this->paper_submission_interface->get_by_id($paper_id);
		$this->assign_review_interface->add($user_id, $paper);
		return back();
	}
}
