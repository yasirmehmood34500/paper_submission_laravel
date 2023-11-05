<?php

namespace App\Repositories;

use App\Interfaces\AuthorContributorRuleInterface;
use App\Models\AuthorContributorRule;

class AuthorContributorRuleRepository implements AuthorContributorRuleInterface
{
	public function __construct(protected AuthorContributorRule $author_contributor_rule_model)
	{
		// Your constructor code here
	}
	public function all()
	{
		return $this->author_contributor_rule_model->get();
	}
}