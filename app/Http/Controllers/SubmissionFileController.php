<?php

namespace App\Http\Controllers;

use App\Interfaces\SubmissionFileInterface;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;

class SubmissionFileController extends Controller
{
	public function __construct(protected SubmissionFileInterface $submission_file_interface)
	{
		//
	}
	public function upload_file(Request $request)
	{
		SubmissionFile::create([
			'paper_submission_id' => session('paper_submission_id'),
			'file_name' => $request->file_name,
			'submission_file_type_id' => $request->submission_file_type_id,
		]);
		return back();
	}
	public function delete_file($id)
	{
		$this->submission_file_interface->delete($id);
		return back();
	}
}
