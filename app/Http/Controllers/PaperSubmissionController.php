<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthorContributorInterface;
use App\Interfaces\AuthorContributorRuleInterface;
use App\Interfaces\PaperSubmissionInterface;
use App\Interfaces\SubmissionFileInterface;
use App\Interfaces\SubmissionFileTypeInterface;
use App\Interfaces\SubmissionRequirementInterface;
use App\Mail\PaperSubmissionEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaperSubmissionController extends Controller
{
	public function __construct(
		protected PaperSubmissionInterface $paper_submission_interface,
		protected SubmissionFileInterface $submission_file_interface,
		protected AuthorContributorInterface $author_contributor_interface,
		protected AuthorContributorRuleInterface $author_contributor_rule_interface,
		protected SubmissionFileTypeInterface $submission_file_type_interface,
		protected SubmissionRequirementInterface $submission_requirement_interface
	) {
		//
	}
	public function submission_1()
	{
		$this->authorize('new_paper_submission');
		return view('pages.submission.submission1')->with([
			'meta_title' => 'Submission Step 1',
			'submission_requirements' => $this->submission_requirement_interface->view()
		]);
	}
	public function submission_2()
	{
		$this->authorize('new_paper_submission');
		if (!session()->has('paper_submission_id')) {
			return redirect()->route('submission_step_1');
		}
		$paper = $this->paper_submission_interface->paper_get_by_id(session('paper_submission_id'));
		if (!$paper && session('paper_submission_id') != 0) {
			return redirect()->route('submission_step_1');
		}
		return view('pages.submission.submission2')->with([
			'meta_title' => 'Submission Step 2',
			'submission_paper' => $paper
		]);
	}
	public function submission_3()
	{
		$this->authorize('new_paper_submission');
		if (!session()->has('paper_submission_id')) {
			return redirect()->route('submission_step_1');
		}
		$paper = $this->paper_submission_interface->paper_get_by_id(session('paper_submission_id'));
		if (!$paper) {
			return redirect()->route('submission_step_1');
		}
		return view('pages.submission.submission3')->with([
			'meta_title' => 'Submission Step 3',
			'paper_contributors' => $this->author_contributor_interface->get_by_paper_id(session('paper_submission_id')),
			'contributor_rules' => $this->author_contributor_rule_interface->all(),
			'submission_paper' => $paper
		]);
	}
	public function submission_4()
	{
		$this->authorize('new_paper_submission');
		if (!session()->has('paper_submission_id')) {
			return redirect()->route('submission_step_1');
		}
		$paper = $this->paper_submission_interface->paper_get_by_id(session('paper_submission_id'));
		if (!$paper) {
			return redirect()->route('submission_step_1');
		}
		return view('pages.submission.submission4')->with([
			'meta_title' => 'Submission Step 4',
			'paper_files' => $this->submission_file_interface->get_by_paper_id(session('paper_submission_id')),
			'paper_file_types' => $this->submission_file_type_interface->all(),
			'submission_paper' => $paper
		]);
	}

	public function my_submission($in_draft = 0)
	{
		$this->authorize('author_my_submission');
		return view('pages.paper.view')->with([
			'meta_title' => 'My Submission',
			'my_submissions' => $this->paper_submission_interface->my_submission($in_draft),
		]);
	}

	public function view_paper_detail($id)
	{
		$this->authorize('author_my_submission');
		$paper = $this->paper_submission_interface->paper_detail_get_by_id($id);
		if (!$paper) {
			return back();
		}
		return view('pages.paper.detail')->with([
			'meta_title' => 'Paper Detail',
			'paper' => $paper,
			'paper_contributors' => $this->author_contributor_interface->get_by_paper_id($paper->id),
			'paper_files' => $this->submission_file_interface->get_by_paper_id($paper->id),
		]);
	}
	public function continue_draft($id)
	{
		$this->authorize('new_paper_submission');
		$paper = $this->paper_submission_interface->continue_draft($id);
		if ($paper) {
			session(['paper_submission_id' => $paper->id]);
			return redirect()->route('submission_step_2');
		} else {
			return back();
		}
	}



	public function submission_1_req(Request $request)
	{
		$this->authorize('new_paper_submission');
		session(['paper_submission_id' => 0]);
		return redirect()->route('submission_step_2');
	}
	public function submission_2_req(Request $request)
	{
		$this->authorize('new_paper_submission');
		$paper = $this->paper_submission_interface->create_update_paper_with_id($request, session('paper_submission_id'));
		session(['paper_submission_id' => $paper->id]);
		return redirect()->route('submission_step_3');
	}
	public function submission_3_req(Request $request)
	{
		$this->authorize('new_paper_submission');
		return redirect()->route('submission_step_4');
	}
	public function submission_4_req(Request $request)
	{
		$this->authorize('new_paper_submission');
		$paper = $this->paper_submission_interface->submit_update_paper_with_id($request, session('paper_submission_id'));
		session()->forget('paper_submission_id');
		Mail::to(auth()->user()->email)->send(new PaperSubmissionEmail($paper->paper_no, $paper->title, auth()->user()->name));
		return redirect()->route('my_submission');
	}

	public function all_submissions_page()
	{
		$this->authorize('view_all_submission');
		return view('pages.paper.view')->with([
			'meta_title' => 'All Submissioin',
			'my_submissions' => $this->paper_submission_interface->all_submissions(),
		]);
	}
}
