<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Gets the global - error we can't explain message, specified in the language file.
	 * @return string
	 */
	protected function commonError (): string
	{
		return __("strings.error_global");
	}

	/**
	 * Gets the global - success we created something message, specified in the language file.
	 * @return string
	 */
	public function storeOkay (): string
	{
		$class = static::class;
		$controllerName = class_basename($class);
		$model = str_replace(["Controller", "controller"], "", $controllerName);
		if (strlen($model < 1))
			$model = "Record";
		return __("strings.success_global", ['model' => $model]);
	}

	/**
	 * Gets the global - success we created something message, specified in the language file.
	 * @return string
	 */
	public function deleteOkay (): string
	{
		$class = static::class;
		$controllerName = class_basename($class);
		$model = str_replace(["Controller", "controller"], "", $controllerName);
		if (strlen($model < 1))
			$model = "Record";
		return __("strings.success_global", ['model' => $model]);
	}

	/**
	 * Gets the global - success we created something message, specified in the language file.
	 * @return string
	 */
	public function statusChangeOkay (): string
	{
		$class = static::class;
		$controllerName = class_basename($class);
		$model = str_replace(["Controller", "controller"], "", $controllerName);
		if (strlen($model < 1))
			$model = "Record";
		return __("strings.success_global", ['model' => $model]);
	}
}
