<?php

namespace App\Console\Commands;

use App\Core\Primitives\Arrays;
use Illuminate\Console\Command;

class UnitTest extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'unit:test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct ()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle ()
	{
		
	}

	protected function imperialToMetricLength ($value)
	{
		return round($value * 30.48, 2);
	}

	protected function imperialToMetricWeight ($value)
	{
		return round($value / 2.20462, 2);
	}
}
