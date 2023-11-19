<?php

namespace App\Repositories;

use App\Interfaces\AssignReviewInterface;

use App\Models\AssignReview;
use App\Models\PaperSubmission;

class AssignReviewRepository implements AssignReviewInterface
{
	public function __construct(protected AssignReview $assign_review_model)
	{
		// Your constructor code here
	}
	public function add($user_id, $paper)
	{
		$this->assign_review_model->firstOrCreate(
			[
				'user_id' => $user_id,
				'paper_submission_id' => $paper->id,
				'revision' => $paper->revision
			]
		);
		$paper->status = PaperSubmission::UNDER_REVIEW_STATUS;
		$paper->save();
		return true;
	}
	public function get_by_paper_id($paper_id)
	{
		return $this->assign_review_model->with('user')->where('paper_submission_id', $paper_id)->get();
	}
	public function view_reviewer_assign_paper()
	{
		return $this->assign_review_model->with('paper_submission')->where('user_id', auth()->id())->get();
	}
	public function revision_no_of_assign_paper($paper_id)
	{
		return $this->assign_review_model->where('user_id', auth()->id())->where('paper_submission_id', $paper_id)->get()->pluck('revision');
	}
}
