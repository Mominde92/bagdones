<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('user_id');
            $table->bigInteger('area_id');
            $table->bigInteger('bulding_number');
            $table->bigInteger('floor_number');
            $table->bigInteger('user_id');
            $table->string('Street_name', 150);
            $table->string('note', 150);
            $table->string('longitude', 150);
            $table->string('latitude', 150);
            $table->string('google_maps_link', 150);
            $table->bigInteger('current_address', 150);
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
        Schema::dropIfExists('address');
    }
}
