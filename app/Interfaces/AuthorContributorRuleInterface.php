<?php

namespace App\Interfaces;

interface AuthorContributorRuleInterface
{
	public function all();
	public function add($request);
	public function delete($id);
}