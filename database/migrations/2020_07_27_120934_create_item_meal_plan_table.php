<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemMealPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_plan_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('meal_plan_id')->nullable();
            $table->unsignedInteger('item_id')->nullable();
            $table->tinyInteger('slab')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_plan_items');
    }
}
