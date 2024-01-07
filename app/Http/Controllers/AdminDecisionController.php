<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminDecisionInterface;
use Illuminate\Http\Request;

class AdminDecisionController extends Controller
{
	public function __construct(protected AdminDecisionInterface $admin_decision_interface)
	{
		//
	}
}
