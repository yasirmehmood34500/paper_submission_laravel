<?php

namespace App\Interfaces;

interface LoginInterface
{
	public function login_req($request);
	public function logout();
	public function register_req($request);
	public function forget_password_req($request);
	public function reset_password_page($token);
	public function reset_password_req($request, $token);
}