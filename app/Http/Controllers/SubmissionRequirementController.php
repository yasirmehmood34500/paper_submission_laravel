<?php

namespace App\Http\Controllers;

use App\Interfaces\SubmissionRequirementInterface;
use Illuminate\Http\Request;

class SubmissionRequirementController extends Controller
{
	public function __construct(protected SubmissionRequirementInterface $submission_requirement_interface)
	{
		//
	}
	public function view()
	{
		return view('pages.submission-requirement.view')->with([
			'submission_requirements' => $this->submission_requirement_interface->view()
		]);
	}
	public function create(Request $request)
	{
		$this->submission_requirement_interface->create($request);
		return back();
	}
	public function delete($id)
	{
		$this->submission_requirement_interface->delete($id);
		return back();
	}
}
