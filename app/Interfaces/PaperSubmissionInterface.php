<?php

namespace App\Interfaces;

interface PaperSubmissionInterface
{
	public function create_update_paper_with_id($request, $id);
	public function submit_update_paper_with_id($request, $id);
	public function my_submission($in_draft);
	public function continue_draft($id);
	public function get_by_id($paper_id);
	public function all_submissions();
	public function paper_status_wise($status);
	public function revision_reply_send($request);
}
