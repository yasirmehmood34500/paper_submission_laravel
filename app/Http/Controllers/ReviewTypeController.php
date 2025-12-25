<?php

namespace App\Http\Controllers;

use App\Interfaces\ReviewTypeInterface;
use Illuminate\Http\Request;

class ReviewTypeController extends Controller
{
	public function __construct(protected ReviewTypeInterface $review_type_interface){
	 //
	}
	public function view()
	{
		$this->AllowPermission(['view_review_type', 'add_review_type']);
		return view('pages.review-type.view')->with([
			'meta_title' => 'Review Type',
			'review_types' =>  $this->review_type_interface->all()
		]);
	}
	public function add(Request $request)
	{
		$this->authorize('add_review_type');
		$this->review_type_interface->add($request);
		return back();
	}
	public function delete($id)
	{
		$this->authorize('delete_review_type');
		$this->review_type_interface->delete($id);
		return back();
	}
}