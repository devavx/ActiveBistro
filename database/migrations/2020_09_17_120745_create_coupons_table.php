<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
		Schema::create('coupons', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('code')->unique();
			$table->string('description', 1000)->nullable();
			$table->dateTime('valid_from')->nullable();
			$table->dateTime('valid_until')->nullable();
			$table->boolean('active')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down ()
	{
		Schema::dropIfExists('coupons');
	}
}
