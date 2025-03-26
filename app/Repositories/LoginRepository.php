<?php

namespace App\Repositories;

use App\Interfaces\LoginInterface;
use App\Mail\ForgetPasswordEmail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginRepository implements LoginInterface
{
	public function __construct(protected User $user_model, protected Role $role_model)
	{
		// Your constructor code here
	}
	public function login_req($request): array
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
	public function logout(): bool
	{
		if (Auth::check()) {
			Auth::logout();
			return true;
		}
		return false;
	}
	public function register_req($request): array
	{
		$already_registered = $this->user_model->where('email', $request['email'])->first();
		if ($already_registered) {
			return [false, 'Email already registered'];
		}
		$request['user_level'] = $this->user_model::AUTHOR;
		$user = $this->user_model->create($request->except('_token'));
		$this->assign_permission_to_user($user, (int) $this->user_model::AUTHOR);
		Auth::login($user);
		return [true, 'Registration Successfully'];
	}
	public static function assign_permission_to_user(User $user, int $role_id): bool
	{
		$roles = Role::where('user_level', $role_id)->get()->pluck("id");
		$user->roles()->sync($roles);
		return true;
	}
	public function forget_password_req($request)
	{
		$user = $this->user_model->where('email', $request['email'])->first();
		if (!$user) {
			return [false, 'Email not found'];
		}
		$token = md5($user->email . time());
		$user->reset_password_token = $token;
		$user->save();
		if (config('app.env') == 'production') {
			try {
				Mail::to($user->email)->send(new ForgetPasswordEmail($token, $user->name));
			} catch (\Throwable $th) {
				info($th->getMessage());
			}
		}
		return [true, 'Check Email'];
	}
	public function reset_password_page($token)
	{
		$available = $this->user_model->where('reset_password_token', $token)->first();
		if (!$available) {
			return false;
		}
		return true;
	}
	public function reset_password_req($request, $token)
	{
		$user = $this->user_model->where('reset_password_token', $token)->first();
		if (!$user) {
			return [false, "Password Reset Failed"];
		}
		$user->password = $request['password'];
		$user->reset_password_token = null;
		$user->save();
		return [true, "Password Reset Success"];
	}
}
