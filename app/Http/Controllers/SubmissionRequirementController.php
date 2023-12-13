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
		$this->AllowPermission(['add_paper_submission_requirement', 'view_paper_submission_requirement']);
		return view('pages.submission-requirement.view')->with([
			'submission_requirements' => $this->submission_requirement_interface->view()
		]);
	}
	public function create(Request $request)
	{
		$this->authorize('add_paper_submission_requirement');
		$this->submission_requirement_interface->create($request);
		return back();
	}
	public function delete($id)
	{
		$this->authorize('delete_paper_submission_requirement');
		$this->submission_requirement_interface->delete($id);
		return back();
	}
}
