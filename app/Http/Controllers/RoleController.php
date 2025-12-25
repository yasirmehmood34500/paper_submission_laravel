<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleInterface;

class RoleController extends Controller
{
	public function __construct(protected RoleInterface $role_interface)
	{
		//
	}
}
