<?php

namespace App\Repositories;

use App\Interfaces\AdminDecisionInterface;

use App\Models\AdminDecision;
use App\Models\PaperSubmission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class AdminDecisionRepository implements AdminDecisionInterface
{
	public function __construct(protected AdminDecision $admin_decision_model, protected PaperSubmission $paper_submission_model)
	{
		// Your constructor code here
	}
	public function revision_send_to_author($request): bool
	{
		$filenames = " ";
		if ($request->hasFile('file_name')) {
			$files = $request->file('file_name');
			$path = 'uploads/admin_reply/';
			if (!Storage::exists($path)) {
				Storage::makeDirectory($path);
			}
			foreach ($files as $file) {
				$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
				$file->move(storage_path('app/public/' . $path), $filename);
				$filenames = $filenames . $filename . ",";
			}
		}
		$request['file'] = trim(mb_substr($filenames, 0, -1));
		$request['paper_submission_id'] = $request['paper_id'];
		$this->admin_decision_model->create($request->except(['paper_id', '_token', 'subject']));
		$paper = $this->paper_submission_model->where('id', $request['paper_id'])->first();
		if ($paper) {
			$paper->status = $this->paper_submission_model::PENDING_FROM_AUTHOR_STATUS;
			$paper->increment('revision');
			$paper->save();
		}
		return true;
	}
	public function get_by_paper_id($paper_id): AdminDecision | Collection
	{
		return $this->admin_decision_model->with('review_type')->where('paper_submission_id', $paper_id)->get();
	}
}
