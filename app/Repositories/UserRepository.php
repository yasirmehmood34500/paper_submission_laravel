<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\Role;
use App\Models\User;

class UserRepository implements UserInterface
{
	public function __construct(protected User $user_model, protected Role $role_model)
	{
		// Your constructor code here
	}
	public function view_user_by_level($user_level)
	{
		return $this->user_model->where('user_level', $user_level)->get();
	}
	public function create($request)
	{
		$user = $this->user_model->updateOrCreate(
			['email' => $request['email']],
			$request->except('_token')
		);
		$roles = $this->role_model->where('user_level', $request->user_level)->get()->pluck("id");
		$user->roles()->sync($roles);
		return true;
	}
	public function single($id)
	{
		return $this->user_model->with('roles')->where('id', $id)->first();
	}
}
