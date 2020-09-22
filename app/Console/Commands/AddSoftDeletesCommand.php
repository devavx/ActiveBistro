<?php

namespace App\Console\Commands;

use App\Category;
use App\Faq;
use App\Ingredient;
use App\Item;
use App\ItemType;
use App\MealPlan;
use App\Models\Address;
use App\Models\Allergy;
use App\Models\Coupon;
use App\Models\Order;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AddSoftDeletesCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'add:sd';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Adds a deleted_at column to all specified tables.';

	/**
	 * List of all the models whose bound tables will get a deleted_at column.
	 *
	 * @var array
	 */
	protected $models;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct ()
	{
		parent::__construct();
		$this->models = [
			Address::class => 'delivery_notes',
			Allergy::class => 'active',
			Category::class => 'active',
			Coupon::class => 'active',
			Faq::class => 'active',
			Ingredient::class => 'active',
			Item::class => 'active',
			ItemType::class => 'active',
			MealPlan::class => 'active',
			Order::class => 'status',
			User::class => 'remember_token',
		];
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle ()
	{
		Collection::make($this->models)->each(function (string $column, string $slug) {
			$model = new $slug;
			$table = $model->getTable();
			$model = class_basename($slug);
			if (!$this->hasColumn($table, 'deleted_at')) {
				DB::statement("ALTER TABLE {$table} ADD `deleted_at` timestamp null after `{$column}`");
				echo sprintf("Processed model {$model}.\n");
			} else {
				echo sprintf("Model {$model} already has column.\n");
			}
		});
	}

	protected function hasColumn (string $table, string $column)
	{
		return count(DB::select(DB::raw("SHOW COLUMNS FROM `{$table}` LIKE '{$column}'"))) > 0;
	}
}
