<?php

namespace App\Interfaces;

interface AuthorContributorInterface
{
	public function create($request, $paper_id);
	public function delete($id);
	public function get_by_paper_id($paper_id);
}
