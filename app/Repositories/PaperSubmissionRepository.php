<?php

namespace App\Repositories;

use App\Interfaces\PaperSubmissionInterface;
use App\Models\PaperSubmission;

class PaperSubmissionRepository implements PaperSubmissionInterface
{
	public function __construct(protected PaperSubmission $paper_submission_model)
	{
		// Your constructor code here
	}
	public function paper_get_by_id($id)
	{
		return $this->paper_submission_model->where('id', $id)->where('in_draft', 1)->where('user_id', auth()->id())->first();
	}
	public function create_update_paper_with_id($request, $id)
	{
		if ($request['paper_no'] == 'none') {
			$today_no_of_papers = $this->paper_submission_model->where('start_date', date("Y-m-d"))->count();
			$request['paper_no'] = config('app.name') . "-" . date("dmy") . $today_no_of_papers + 1;
		}
		$request['user_id'] = auth()->id();
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
				'in_draft' => 0
			]
		);
	}
	public function my_submission($in_draft)
	{
		return $this->paper_submission_model->where('in_draft', $in_draft)->where('user_id', auth()->id())->orderBy('id', 'DESC')->get();
	}
	public function continue_draft($id)
	{
		return $this->paper_submission_model->where('in_draft', 1)->where('user_id', auth()->id())->where('id', $id)->first();
	}
	public function paper_detail_get_by_id($id)
	{
		$paper = $this->paper_submission_model->where('in_draft', 0);
		if (auth()->user()->user_level != 1) {
			$paper = $paper->where('user_id', auth()->id());
		}
		return $paper->where('id', $id)->first();
	}
	public function all_submissions()
	{
		return $this->paper_submission_model->with('user')->where('in_draft', 0)->orderBy('id', 'DESC')->get();
	}
}
