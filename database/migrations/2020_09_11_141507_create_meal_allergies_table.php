<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealAllergiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up () {
		Schema::create('meal_plan_allergies', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('meal_plan_id');
			$table->unsignedBigInteger('allergy_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down () {
		Schema::dropIfExists('meal_plan_allergies');
	}
}
