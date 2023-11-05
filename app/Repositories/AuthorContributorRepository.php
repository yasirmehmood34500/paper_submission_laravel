<?php

namespace App\Repositories;

use App\Interfaces\AuthorContributorInterface;
use App\Models\AuthorContributor;

class AuthorContributorRepository implements AuthorContributorInterface
{
	public function __construct(protected AuthorContributor $author_contributor_model)
	{
		// Your constructor code here
	}
	public function create($request, $paper_id)
	{
		$request['paper_submission_id'] = $paper_id;
		$this->author_contributor_model->create($request->except('_token'));
		return true;
	}
	public function delete($id)
	{
		$this->author_contributor_model->where('id', $id)->delete();
		return true;
	}
	public function get_by_paper_id($paper_id){
		return $this->author_contributor_model->with('contributor_rule')->where('paper_submission_id', $paper_id)->get();
	}
}
