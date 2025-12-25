<?php

namespace App\Repositories;

use App\Interfaces\AuthorContributorRuleInterface;
use App\Models\AuthorContributorRule;
use Illuminate\Database\Eloquent\Collection;

class AuthorContributorRuleRepository implements AuthorContributorRuleInterface
{
	public function __construct(protected AuthorContributorRule $author_contributor_rule_model)
	{
		// Your constructor code here
	}
	public function all(): AuthorContributorRule | Collection
	{
		return $this->author_contributor_rule_model->get();
	}
	public function add($request): bool
	{
		$this->author_contributor_rule_model->updateOrCreate(
			['name' => $request['name']],
			['name' => $request['name']]
		);
		return true;
	}
	public function delete($id): bool
	{
		$this->author_contributor_rule_model->where('id', $id)->delete();
		return true;
	}
}
