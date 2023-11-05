<?php

namespace App\Repositories;

use App\Interfaces\SubmissionFileTypeInterface;
use App\Models\SubmissionFileType;

class SubmissionFileTypeRepository implements SubmissionFileTypeInterface
{
	public function __construct(protected SubmissionFileType $submission_file_type_model)
	{
		// Your constructor code here
	}
	public function all()
	{
		return $this->submission_file_type_model->get();
	}
	public function add($request)
	{
		$this->submission_file_type_model->updateOrCreate(
			['name' => $request['name']],
			['name' => $request['name']]
		);
		return true;
	}
}
