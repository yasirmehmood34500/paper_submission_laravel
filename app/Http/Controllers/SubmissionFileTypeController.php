<?php

namespace App\Http\Controllers;

use App\Interfaces\SubmissionFileTypeInterface;
use Illuminate\Http\Request;

class SubmissionFileTypeController extends Controller
{
	public function __construct(protected SubmissionFileTypeInterface $submission_file_type_interface)
	{
		//
	}
	public function view()
	{
		$this->AllowPermission(['add_paper_file_type', 'view_paper_file_type']);
		return view('pages.file-type.view')->with([
			'meta_title' => 'File Type',
			'file_types' =>  $this->submission_file_type_interface->all()
		]);
	}
	public function add(Request $request)
	{
		$this->authorize('add_paper_file_type');
		$this->submission_file_type_interface->add($request);
		return back();
	}
	public function delete($id)
	{
		$this->authorize('delete_paper_file_type');
		$this->submission_file_type_interface->delete($id);
		return back();
	}
}
