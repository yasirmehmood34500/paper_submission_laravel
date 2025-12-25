<?php

namespace App\Interfaces;

interface AssignReviewInterface
{
	public function add($user_id, $paper);
	public function get_by_paper_id($paper_id);
	public function view_reviewer_assign_paper();
	public function revision_no_of_assign_paper($paper_id);
	public function reviewer_reply_paper($request);
}
