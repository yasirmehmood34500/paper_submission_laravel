<?php

namespace App\Interfaces;

interface SubmissionFileTypeInterface
{
	public function all();
	public function add($request);
}