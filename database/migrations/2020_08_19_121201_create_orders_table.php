<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('address_id');
			$table->unsignedBigInteger('second_address_id');
			$table->string('invoice_id');
			$table->enum('payment_slab', ['monthly', 'weekly']);
			$table->integer('quantity')->default(0);
			$table->double('sub_total', 8, 2);
			$table->double('total', 8, 2);
			$table->string('status')->default('pending');
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
		Schema::dropIfExists('orders');
	}
}
