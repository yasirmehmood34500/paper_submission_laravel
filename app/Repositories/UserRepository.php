<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
	public function __construct(protected User $user_model)
	{
		// Your constructor code here
	}
	public function view_user_by_level($user_level)
	{
		return $this->user_model->where('user_level', $user_level)->get();
	}
	public function create($request)
	{
		$request['user_level'] = 2;
		$this->user_model->updateOrCreate(
			['email' => $request['email']],
			$request->except('_token')
		);
		return true;
	}
}
