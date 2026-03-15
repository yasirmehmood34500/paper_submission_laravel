<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Interfaces\PaperSubmissionInterface;
use App\Models\AssignReview;
use App\Models\PaperSubmission;
use Illuminate\Database\Eloquent\Collection;

class PaperSubmissionRepository implements PaperSubmissionInterface
{
	public function __construct(protected PaperSubmission $paper_submission_model)
	{
		// Your constructor code here
	}
	public function create_update_paper_with_id($request, $id)
	{
		if ($request['paper_no'] == 'none') {
			$today_no_of_papers = $this->paper_submission_model->where('start_date', date("Y-m-d"))->count();
			$request['paper_no'] = config('constants.journal_stand_for') . "-" . date("ymd") . $today_no_of_papers + 1;
		}
		$request['user_id'] = auth()->id();
		$request['start_date'] = date("Y-m-d");
		return $this->paper_submission_model->updateOrCreate(
			['id' => $id],
			$request->except('_token')
		);
	}
	public function submit_update_paper_with_id($request, $id)
	{
		return $this->paper_submission_model->updateOrCreate(
			['id' => $id],
			[
				'send_date' => date('Y-m-d'),
				'created_at' => date('Y-m-d H:i:s'),
				'in_draft' => 0,
			]
		);
	}
	public function my_submission($in_draft): PaperSubmission|Collection
	{
		return $this->paper_submission_model->where('in_draft', $in_draft)->where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
	}
	public function continue_draft($id): ?PaperSubmission
	{
		return $this->paper_submission_model->where('in_draft', 1)->where('user_id', auth()->id())->where('id', $id)->first();
	}
	public function get_by_id($paper_id): ?PaperSubmission
	{
		$paper = $this->paper_submission_model->where('id', $paper_id);
		if (!Controller::CheckAllowedPermission(['view_all_submission'])) {
			$paper = $paper->where('user_id', auth()->id());
		}
		$paper = $paper->first();
		if ($paper == null) {
			if (Controller::CheckAllowedPermission(['view_assign_paper'])) {
				$assign_review_paper = AssignReview::where('paper_submission_id', $paper_id)->where('user_id', auth()->id())->first();
				if ($assign_review_paper) {
					$paper = $this->paper_submission_model->where('id', $paper_id)->first();
				}
			}
		}
		return $paper;
	}
	public function all_submissions(): PaperSubmission|Collection
	{
		return $this->paper_submission_model->with('user')->where('in_draft', 0)->orderBy('created_at', 'DESC')->get();
	}
	public function paper_status_wise($status): PaperSubmission|Collection
	{
		return $this->paper_submission_model->with('user')->where('in_draft', 0)->where('status', $status)->orderBy('send_date', 'DESC')->get();
	}
	public function revision_reply_send($request): bool
	{
		$this->paper_submission_model->where('user_id', auth()->id())->where('id', $request['paper_id'])->update(['status' => $this->paper_submission_model::PENDING_FROM_EDITOR_STATUS, 'downloaded' => 0]);
		return true;
	}
	public function delete_paper($id): bool
	{
		$this->paper_submission_model->where('id', $id)->delete();
		return true;
	}
}
