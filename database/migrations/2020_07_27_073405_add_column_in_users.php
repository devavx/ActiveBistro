<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->after('address');
            $table->boolean('click_to_verify')->after('gender');
            $table->string('phone')->after('click_to_verify');
            $table->string('dob')->after('phone');
            $table->string('gender_info')->after('dob');
            $table->string('about')->after('gender_info');
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
            $table->dropColumn(['gender','click_to_verify','phone','dob','gender_info','about']);
        });
    }
}
