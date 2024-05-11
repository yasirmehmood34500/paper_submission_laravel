<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
	public function login_as_user_link($user_id)
	{
		$this->authorize('login_as_user');
		Auth::loginUsingId($user_id);
		return to_route('home');
	}
	public function update_password()
	{
		return view('pages.profile-setting.update-password');
	}
	public function update_password_req(Request $request)
	{
		$res = $this->user_interface->update_password($request);
		return back()->with('error', $res ? 'Password Updated' : 'Both Password Should be same');
	}
}
