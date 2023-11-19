<?php

namespace App\Interfaces;

interface AssignReviewInterface
{
	public function add($user_id, $paper);
	public function get_by_paper_id($paper_id);
}
