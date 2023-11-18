<?php

namespace App\Interfaces;

interface PaperSubmissionInterface
{
	public function create_update_paper_with_id($request, $id);
	public function submit_update_paper_with_id($request, $id);
	public function my_submission($in_draft);
	public function continue_draft($id);
	public function get_by_id_with_draft($paper_id);
	public function all_submissions();
}
