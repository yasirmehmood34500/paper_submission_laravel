<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthorContributorRuleInterface;
use Illuminate\Http\Request;

class AuthorContributorRuleController extends Controller
{
	public function __construct(protected AuthorContributorRuleInterface $author_contributor_rule_interface)
	{
		//
	}
	public function view()
	{
		$this->AllowPermission(['view_contributor_rule', 'add_contributor_rule']);
		return view('pages.contributor-rule.view')->with([
			'meta_title' => 'Contribitor Role',
			'contributor_rules' =>  $this->author_contributor_rule_interface->all()
		]);
	}
	public function add(Request $request)
	{
		$this->authorize('add_contributor_rule');
		$this->author_contributor_rule_interface->add($request);
		return back();
	}
	public function delete($id)
	{
		$this->authorize('delete_contributor_rule');
		$this->author_contributor_rule_interface->delete($id);
		return back();
	}
}
