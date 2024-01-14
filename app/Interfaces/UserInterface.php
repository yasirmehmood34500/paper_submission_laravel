<?php

namespace App\Interfaces;

interface UserInterface
{
	public function view_user_by_level($user_level);
	public function create($request);
	public function update_password($request);
	public function single($id);
	public function search_user_by_level($user_level, $search);
}
