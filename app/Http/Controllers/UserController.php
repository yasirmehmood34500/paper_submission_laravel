<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct(protected UserInterface $user_interface)
	{
		//
	}

	public function view_author()
	{
		$this->authorize('view_author');
		return view('pages.author.view')->with([
			'meta_title' => 'Authors',
			'author_users' => $this->user_interface->view_user_by_level(User::AUTHOR),
		]);
	}

	public function add_author_page()
	{
		$this->authorize('add_author');
		return view('pages.author.add')->with([
			'meta_title' => 'Add Author',
		]);
	}

	public function add_author_req(Request $request)
	{
		$this->authorize('add_author');
		$this->user_interface->create($request);
		return redirect()->route('view_author_page');
	}

	public function view_reviewer()
	{
		$this->authorize('view_reviewer');
		return view('pages.reviewer.view')->with([
			'meta_title' => 'Reviewers',
			'reviewer_users' => $this->user_interface->view_user_by_level(User::REVIEWER),
		]);
	}

	public function add_reviewer_page()
	{
		$this->authorize('add_reviewer');
		return view('pages.reviewer.add')->with([
			'meta_title' => 'Add Reviewer',
		]);
	}

	public function add_reviewer_req(Request $request)
	{
		$this->authorize('add_reviewer');
		$this->user_interface->create($request);
		return redirect()->route('view_reviewer_page');
	}

	public function search_reviewer(Request $request)
	{
		return response()->json([
			'user' => $this->user_interface->search_user_by_level(user_level: User::REVIEWER, search: $request->text)
		]);
	}
}
