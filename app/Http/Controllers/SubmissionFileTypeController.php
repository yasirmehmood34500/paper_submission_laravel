<?php

namespace App\Http\Controllers;

use App\Interfaces\SubmissionFileTypeInterface;
use Illuminate\Http\Request;

class SubmissionFileTypeController extends Controller
{
	public function __construct(protected SubmissionFileTypeInterface $submissionfiletypeInterface){
	 //
	}
}