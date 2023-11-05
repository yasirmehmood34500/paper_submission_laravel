<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthorContributorRuleInterface;
use Illuminate\Http\Request;

class AuthorContributorRuleController extends Controller
{
	public function __construct(protected AuthorContributorRuleInterface $author_contributor_rule_interface){
	 //
	}
	public function view(){
		return view('pages.contributor-rule.view')->with([
			'meta_title' => 'Contribitor Rule',
			'contributor_rules' =>  $this->author_contributor_rule_interface->all()
		]);
	}
	public function add(Request $request){
		$this->author_contributor_rule_interface->add($request);
		return back();
	}
}