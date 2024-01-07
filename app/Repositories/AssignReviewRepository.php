<?php

namespace App\Repositories;

use App\Interfaces\AssignReviewInterface;

use App\Models\AssignReview;
use App\Models\PaperSubmission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class AssignReviewRepository implements AssignReviewInterface
{
	public function __construct(protected AssignReview $assign_review_model)
	{
		// Your constructor code here
	}
	public function add($user_id, $paper): bool
	{
		$this->assign_review_model->firstOrCreate(
			[
				'user_id' => $user_id,
				'paper_submission_id' => $paper->id,
				'revision' => $paper->revision
			]
		);
		$paper->status = PaperSubmission::UNDER_REVIEW_STATUS;
		$paper->save();
		return true;
	}
	public function get_by_paper_id($paper_id): AssignReview | Collection
	{
		return $this->assign_review_model->with(['user', 'review_type'])->where('paper_submission_id', $paper_id)->get();
	}
	public function view_reviewer_assign_paper(): AssignReview | Collection
	{
		return $this->assign_review_model->with(['paper_submission', 'review_type'])->where('user_id', auth()->id())->get();
	}
	public function revision_no_of_assign_paper($paper_id)
	{
		return $this->assign_review_model->where('user_id', auth()->id())->where('paper_submission_id', $paper_id)->get()->pluck('revision');
	}
	public function reviewer_reply_paper($request): bool
	{
		$replied_paper = $this->assign_review_model->where('user_id', auth()->id())->where('paper_submission_id', $request['paper_id'])->orderBy('revision', 'DESC')->first();
		if ($replied_paper) {
			$filename = "";
			if ($request->hasFile('file_name')) {
				$file = $request->file('file_name');
				$path = 'uploads/reviewer_reply/';
				$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
				if (!Storage::exists($path)) {
					Storage::makeDirectory($path);
				}
				$file->move(storage_path('app/public/' . $path), $filename);
			}
			$replied_paper->review_type_id = $request['review_type_id'];
			$replied_paper->comment = $request['comment'];
			$replied_paper->file = $filename;
			$replied_paper->save();
		}
		return true;
	}
}
