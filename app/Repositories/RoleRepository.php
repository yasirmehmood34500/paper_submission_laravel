<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleInterface
{
	public function __construct(protected Role $role_model)
	{
		// Your constructor code here
	}
	public function view(): Role | Collection
	{
		return $this->role_model->orderBy('user_level', 'ASC')->get();
	}
}
