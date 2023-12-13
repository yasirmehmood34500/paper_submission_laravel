<?php

namespace App\Repositories;

use App\Interfaces\SubmissionRequirementInterface;
use App\Models\SubmissionRequirement;
use Illuminate\Database\Eloquent\Collection;

class SubmissionRequirementRepository implements SubmissionRequirementInterface
{
	public function __construct(protected SubmissionRequirement $submission_requirement_model)
	{
		// Your constructor code here
	}

	public function view(): SubmissionRequirement | Collection
	{
		return $this->submission_requirement_model->get();
	}
	public function create($request): bool
	{
		$this->submission_requirement_model->create($request->except(['_token']));
		return true;
	}
	public function delete($id): bool
	{
		$this->submission_requirement_model->where('id', $id)->delete();
		return true;
	}
}
