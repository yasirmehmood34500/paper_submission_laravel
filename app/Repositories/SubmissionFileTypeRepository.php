<?php

namespace App\Repositories;

use App\Interfaces\SubmissionFileTypeInterface;
use App\Models\SubmissionFileType;
use Illuminate\Database\Eloquent\Collection;

class SubmissionFileTypeRepository implements SubmissionFileTypeInterface
{
	public function __construct(protected SubmissionFileType $submission_file_type_model)
	{
		// Your constructor code here
	}
	public function all(): SubmissionFileType | Collection
	{
		return $this->submission_file_type_model->get();
	}
	public function add($request): bool
	{
		$this->submission_file_type_model->updateOrCreate(
			['name' => $request['name']],
			['name' => $request['name']]
		);
		return true;
	}
	public function delete($id): bool
	{
		$this->submission_file_type_model->where('id', $id)->delete();
		return true;
	}
}
