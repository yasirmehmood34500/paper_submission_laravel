<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthorContributorRuleInterface;
use Illuminate\Http\Request;

class AuthorContributorRuleController extends Controller
{
	public function __construct(protected AuthorContributorRuleInterface $authorcontributorruleInterface){
	 //
	}
}