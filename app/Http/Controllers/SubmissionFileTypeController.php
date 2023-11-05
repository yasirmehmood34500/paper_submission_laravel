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
		return view('pages.file-type.view')->with([
			'meta_title' => 'File Type',
			'file_types' =>  $this->submission_file_type_interface->all()
		]);
	}
	public function add(Request $request)
	{
		$this->submission_file_type_interface->add($request);
		return back();
	}
}
