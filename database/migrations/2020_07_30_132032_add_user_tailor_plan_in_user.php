<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTailorPlanInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_height')->after('gender_info')->nullable();
            $table->string('weight_total')->after('user_height')->nullable();
            $table->string('user_weight')->after('weight_total')->nullable();
            $table->string('user_targert_weight')->after('user_weight')->nullable();
            $table->string('weight_goal')->after('user_targert_weight')->nullable();
            $table->string('activity_lavel')->after('weight_goal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_height','weight_total','user_weight','user_targert_weight','activity_lavel']);
        });
    }
}
