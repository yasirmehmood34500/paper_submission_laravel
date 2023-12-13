<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleInterface;
use App\Interfaces\RoleUserInterface;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
	public function __construct(protected RoleUserInterface $role_user_interface, protected RoleInterface $role_interface, protected UserInterface $user_interface)
	{
		//
	}
	public function view_user_permission($user_id)
	{
		$this->authorize('assign_user_permission');
		if (auth()->id() == $user_id) {
			abort(403);
		}
		return view('pages.assign-permission.view')->with([
			'meta_title' => 'Assign Permission',
			'roles' => $this->role_interface->view(),
			'user' => $this->user_interface->single($user_id),
		]);
	}
	public function add_user_permission_req(Request $request)
	{
		$this->authorize('assign_user_permission');
		if (auth()->id() == $request->user_id) {
			abort(403);
		}
		$user = $this->user_interface->single($request->user_id);
		$user->roles()->sync($request->roles);
		return back();
	}
}
