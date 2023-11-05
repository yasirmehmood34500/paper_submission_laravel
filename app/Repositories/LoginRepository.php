<?php

namespace App\Repositories;

use App\Interfaces\LoginInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginInterface
{
	public function __construct(protected User $user_model)
	{
		// Your constructor code here
	}
	public function login_req($request)
	{
		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
			$user = $this->user_model->where('email', $request['email'])->first();
			Auth::login($user);
			return [true, 'Successfully Login'];
		} else {
			return [false, 'Invalid credentials'];
		}
	}
	public function logout()
	{
		if (Auth::check()) {
			Auth::logout();
			return true;
		}
		return false;
	}
	public function register_req($request)
	{
		$already_registered = $this->user_model->where('email', $request['email'])->first();
		if ($already_registered) {
			return [false, 'Email already registered'];
		}
		$request['user_level'] = 2;
		$user=$this->user_model->create($request->except('_token'));
		Auth::login($user);
		return [true, 'Registration Successfully'];
	}
}
