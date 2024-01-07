<?php

namespace App\Interfaces;

interface AdminDecisionInterface
{
	public function revision_send_to_author($request);
	public function get_by_paper_id($paper_id);
}
