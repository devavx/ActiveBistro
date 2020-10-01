<?php

namespace App\Core\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

trait BulkDelete
{
	/**
	 * Model against which the bulk delete action will be executed.
	 *
	 * @var string|null|Model
	 */
	protected $model = null;

	/**
	 * @return JsonResponse
	 * @throws \Exception
	 */
	public function deleteBulk ()
	{
		if ($this->model != null) {
			$class = $this->model;
			$name = class_basename($class);
			$result = array();
			$result['success'] = 1;
			$result['message'] = "{$name}(s) deleted successfully!";
			$result['data'] = [];
			$class::query()->whereIn('id', request('items', []))->delete();
			return response()->json($result);
		} else {
			throw new \Exception("No bound model found for this bulk action!");
		}
	}

	/**
	 * Set the model against which the bulk delete action will be executed.
	 *
	 * @var $class string
	 */
	protected function setBoundModel (string $class): void
	{
		$this->model = $class;
	}
}