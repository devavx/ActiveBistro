<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * The path to the "home" route for your application.
	 *
	 * @var string
	 */
	public const HOME = '/home';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot ()
	{
		parent::boot();
	}

	public function map ()
	{
		$this->mapAdminRoutes();
		$this->mapUserRoutes();
	}

	protected function mapAdminRoutes (): void
	{
		Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/admin.php'));
	}

	protected function mapUserRoutes (): void
	{
		Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/user.php'));
	}
}
