<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
	public function __construct(protected User $user_model, protected Role $role_model)
	{
		// Your constructor code here
	}
	public function view_user_by_level($user_level): User | Collection
	{
		return $this->user_model->where('user_level', $user_level)->get();
	}
	public function create($request): bool
	{
		if ($request['email'] == 'admin@gmail.com') {
			return true;
		}
		$user = $this->user_model->updateOrCreate(
			['email' => $request['email']],
			$request->except('_token')
		);
		$roles = $this->role_model->where('user_level', $request->user_level)->get()->pluck("id");
		$user->roles()->sync($roles);
		return true;
	}
	public function single($id): ?User
	{
		return $this->user_model->with('roles')->where('id', $id)->first();
	}
	public function search_user_by_level($user_level, $search): User | Collection
	{
		return $this->user_model
			->where('user_level', $user_level)
			->where(function ($query) use ($search) {
				$query->orWhere('name', 'LIKE', "%$search%")
					->orWhere('email', 'LIKE', "%$search%");
			})->limit(5)->get();
	}
	public function update_password($request): bool
	{
		if ($request['new_password'] === $request['confirm_password']) {
			$this->user_model->where('id', auth()->id())->update(['password' => Hash::make($request['new_password'])]);
			return true;
		} else {
			return false;
		}
	}
}
