<?php

namespace App\Interfaces;

interface SubmissionRequirementInterface
{
	public function view();
	public function create($request);
	public function delete($id);
}