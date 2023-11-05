<?php

namespace App\Repositories;

use App\Interfaces\SubmissionFileInterface;
use App\Models\SubmissionFile;

class SubmissionFileRepository implements SubmissionFileInterface
{
	public function __construct(protected SubmissionFile $submission_file_model)
	{
		// Your constructor code here
	}
	public function get_by_paper_id($paper_id)
	{
		return $this->submission_file_model->with('file_type')->where('paper_submission_id', $paper_id)->get();
	}
	public function delete($id)
	{
		$this->submission_file_model->where('id', $id)->delete();
		return true;
	}
}
