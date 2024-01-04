<?php

namespace App\Repositories;

use App\Interfaces\ReviewTypeInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\ReviewType;

class ReviewTypeRepository implements ReviewTypeInterface
{
	public function __construct(protected ReviewType $review_type_model)
	{
		// Your constructor code here
	}
	public function all(): ReviewType | Collection
	{
		return $this->review_type_model->get();
	}
	public function add($request): bool
	{
		$this->review_type_model->updateOrCreate(
			['name' => $request['name']],
			['name' => $request['name']]
		);
		return true;
	}
	public function delete($id): bool
	{
		$this->review_type_model->where('id', $id)->delete();
		return true;
	}
}