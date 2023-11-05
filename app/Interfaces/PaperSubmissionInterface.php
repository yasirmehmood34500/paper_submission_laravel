<?php

namespace App\Interfaces;

interface PaperSubmissionInterface
{
	public function paper_get_by_id($id);
	public function create_update_paper_with_id($request, $id);
	public function submit_update_paper_with_id($request, $id);
	public function my_submission($in_draft);
	public function continue_draft($id);
	public function paper_detail_get_by_id($id);
}