<?php

use App\Core\Enums\Common\DaysOfWeek;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('day', DaysOfWeek::getValues())->nullable();
            $table->string('address_first_line');
            $table->string('address_second_line')->nullable();
            $table->string('city', 50);
            $table->string('postcode', 10);
            $table->string('delivery_notes', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('addresses');
    }
}
