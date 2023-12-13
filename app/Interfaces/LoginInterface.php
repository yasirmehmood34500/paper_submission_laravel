<?php

namespace App\Interfaces;

interface LoginInterface
{
	public function login_req($request);
	public function logout();
	public function register_req($request);
}