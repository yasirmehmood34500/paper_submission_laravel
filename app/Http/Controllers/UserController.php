<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct(protected UserInterface $user_interface){
	 //
	}

	public function view_author(){
		return view('pages.author.view')->with([
			'meta_title' => 'Authors',
			'author_users' => $this->user_interface->view_user_by_level(2),
		]);
	}

	public function add_author_page(){
		return view('pages.author.add')->with([
			'meta_title' => 'Add Author',
		]);
	}

	public function add_author_req(Request $request){
		$this->user_interface->create($request);
		return redirect()->route('view_author_page');
	}
}