<?php

namespace App\Interfaces;

interface SubmissionFileInterface
{
	public function get_by_paper_id($paper_id);
	public function delete($id);
}