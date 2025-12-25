<?php

namespace App\Http\Controllers;

use App\Interfaces\PaperSubmissionInterface;
use App\Interfaces\SubmissionFileInterface;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionFileController extends Controller
{
	public function __construct(protected SubmissionFileInterface $submission_file_interface, protected PaperSubmissionInterface $paper_submission_interface,)
	{
		//
	}
	public function upload_file(Request $request)
	{
		$this->authorize('new_paper_submission');
		if ($request->hasFile('file_name')) {
			$file = $request->file('file_name');
			$path = 'uploads/submission/';
			$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
			if (!Storage::exists($path)) {
				Storage::makeDirectory($path);
			}
			if (config('app.env') == 'production') {
				$file->move(storage_path('app/public/' . $path), $filename);
			}
			$paper = $this->paper_submission_interface->get_by_id(paper_id: session('paper_submission_id'));
			if ($paper) {
				SubmissionFile::create([
					'paper_submission_id' => session('paper_submission_id'),
					'file_name' => $filename,
					'submission_file_type_id' => $request->submission_file_type_id,
					'revision' => $paper->revision,
				]);
			}
		}
		return back();
	}
	public function revision_upload_file(Request $request)
	{
		$this->authorize('new_paper_submission');
		if ($request->hasFile('file_name')) {
			$file = $request->file('file_name');
			$path = 'uploads/submission/';
			$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
			if (!Storage::exists($path)) {
				Storage::makeDirectory($path);
			}
			if (config('app.env') == 'production') {
				$file->move(storage_path('app/public/' . $path), $filename);
			}
			$paper = $this->paper_submission_interface->get_by_id(paper_id: $request->paper_id);
			if ($paper) {
				SubmissionFile::create([
					'paper_submission_id' => $paper->id,
					'file_name' => $filename,
					'submission_file_type_id' => $request->submission_file_type_id,
					'revision' => $paper->revision,
				]);
			}
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
