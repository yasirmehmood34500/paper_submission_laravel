<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;

use App\Models\Role;

class RoleRepository implements RoleInterface
{
	public function __construct(protected Role $role_model)
	{
		// Your constructor code here
	}
	public function view()
	{
		return $this->role_model->orderBy('user_level', 'ASC')->get();
	}
}
