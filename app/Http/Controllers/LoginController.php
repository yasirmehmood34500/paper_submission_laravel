<?php

namespace App\Http\Controllers;

use App\Interfaces\LoginInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function __construct(protected LoginInterface $loginInterface)
	{
		//
	}
}
