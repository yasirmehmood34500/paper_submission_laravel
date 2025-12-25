<?php

namespace App\Interfaces;

interface ReviewTypeInterface
{
	public function all();
	public function add($request);
	public function delete($id);
}