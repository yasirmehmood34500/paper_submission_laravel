<?php

namespace App\Http\Controllers;

use App\Interfaces\SubmissionFileInterface;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionFileController extends Controller
{
	public function __construct(protected SubmissionFileInterface $submission_file_interface)
	{
		//
	}
	public function upload_file(Request $request)
	{
		$this->authorize('new_paper_submission');
		if ($request->hasFile('file_name')) {
			$file = $request->file('file_name');
			$path = 'uploads/submission/';
			$filename = uniqid() . '.' . $file->getClientOriginalExtension();
			if (!Storage::exists($path)) {
				Storage::makeDirectory($path);
			}
			$file->move(storage_path('app/public/' . $path), $filename);
			SubmissionFile::create([
				'paper_submission_id' => session('paper_submission_id'),
				'file_name' => $filename,
				'submission_file_type_id' => $request->submission_file_type_id,
			]);
		}
		return back();
	}
	public function delete_file($id)
	{
		$this->authorize('new_paper_submission');
		$this->submission_file_interface->delete($id);
		return back();
	}
}
