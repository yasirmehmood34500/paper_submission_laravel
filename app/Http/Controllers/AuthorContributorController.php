<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthorContributorInterface;
use Illuminate\Http\Request;

class AuthorContributorController extends Controller
{
	public function __construct(protected AuthorContributorInterface $author_contributor_interface)
	{
		//
	}

	public function add_contributor(Request $request)
	{
		$this->authorize('new_paper_submission');
		$this->author_contributor_interface->create($request, session('paper_submission_id'));
		return back();
	}
	public function delete_contributor($id)
	{
		$this->authorize('new_paper_submission');
		$this->author_contributor_interface->delete($id);
		return back();
	}
}
