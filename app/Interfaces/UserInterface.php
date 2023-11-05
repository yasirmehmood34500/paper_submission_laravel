<?php

namespace App\Interfaces;

interface UserInterface
{
	public function view_user_by_level($user_level);
	public function create($request);
}