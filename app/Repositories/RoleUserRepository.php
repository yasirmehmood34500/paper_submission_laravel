<?php

namespace App\Repositories;

use App\Interfaces\RoleUserInterface;

use App\Models\RoleUser;

class RoleUserRepository implements RoleUserInterface
{
	public function __construct(protected RoleUser $role_user_model)
	{
		// Your constructor code here
	}
}