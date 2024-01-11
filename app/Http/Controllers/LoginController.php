<?php

namespace App\Http\Controllers;

use App\Interfaces\LoginInterface;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function __construct(protected LoginInterface $loginInterface)
	{
	}
	public function login_page()
	{
		if (auth()->check()) {
			return redirect()->route('home');
		}
		return view('pages.login')->with([
			'meta_title' => 'Login',
		]);
	}
	public function register_page()
	{
		if (auth()->check()) {
			return redirect()->route('home');
		}
		return view('pages.register')->with([
			'meta_title' => 'Register',
		]);
	}
	public function login_req(Request $request)
	{
		$rules = [
			'email' => 'required|email',
			'password' => 'required|min:8',
		];
		$request->validate($rules);
		$resp = $this->loginInterface->login_req($request);
		if ($resp[0]) {
			if (auth()->user()->user_level == User::ADMIN) {
				return to_route('all_submissions_page');
			} else {
				return redirect()->route('home');
			}
		} else {
			return back()->with('error', $resp[1]);
		}
	}
	public function register_req(Request $request)
	{
		$rules = [
			'name' => 'required|string|min:3|max:50',
			'email' => 'required|email',
			'password' => 'required|min:8',
		];
		$request->validate($rules);
		$resp = $this->loginInterface->register_req($request);
		if ($resp[0]) {
			return redirect()->route('home');
		} else {
			return back()->with('error', $resp[1]);
		}
	}
	public function logout()
	{
		if ($this->loginInterface->logout()) {
			return redirect()->route('login');
		} else {
			return back();
		}
	}
}
