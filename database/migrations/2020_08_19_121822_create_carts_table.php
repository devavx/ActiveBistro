<?php

use App\Core\Enums\Common\DietaryRequirement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
		Schema::create('carts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->double('calories', 8, 2)->default(0.0);
			$table->double('fats', 8, 2)->default(0.0);
			$table->double('proteins', 8, 2)->default(0.0);
			$table->double('carbohydrates', 8, 2)->default(0.0);
			$table->boolean('wantBreakfast')->default(false);
			$table->boolean('wantSnacks')->default(false);
			$table->boolean('weekendMeals')->default(false);
			$table->integer('snackCount')->default(0);
			$table->integer('mealsPerDay')->default(2);
			$table->string('dietaryRequirement', 50)->default(DietaryRequirement::None);
			$table->json('allergies');
			$table->json('items');
			$table->string('coupon', 256)->nullable();
			$table->unsignedBigInteger('coupon_id')->nullable();
			$table->double('subTotal', 8, 2)->default(0.0);
			$table->double('total', 8, 2)->default(0.0);
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
		Schema::dropIfExists('carts');
	}
}
