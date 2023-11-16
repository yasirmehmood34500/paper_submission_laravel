<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	public function __construct(protected RoleInterface $role_interface){
	 //
	}
}