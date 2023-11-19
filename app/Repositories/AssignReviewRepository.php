<?php

namespace App\Repositories;

use App\Interfaces\AssignReviewInterface;

use App\Models\AssignReview;

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
		return true;
	}
	public function get_by_paper_id($paper_id)
	{
		return $this->assign_review_model->with('user')->where('paper_submission_id', $paper_id)->get();
	}
}
