<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminDecisionInterface;

class AdminDecisionController extends Controller
{
	public function __construct(protected AdminDecisionInterface $admin_decision_interface)
	{
		//
	}
}
