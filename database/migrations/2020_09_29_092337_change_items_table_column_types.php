<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeItemsTableColumnTypes extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
		Schema::table('items', function (Blueprint $table) {
			$table->double('protein', 6, 2)->change();
			$table->double('calories', 6, 2)->change();
			$table->double('carbs', 6, 2)->change();
			$table->double('fat', 6, 2)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down ()
	{
		Schema::table('items', function (Blueprint $table) {
			$table->string('protein')->change();
			$table->string('calories')->change();
			$table->string('carbs')->change();
			$table->string('fat')->change();
		});
	}
}
