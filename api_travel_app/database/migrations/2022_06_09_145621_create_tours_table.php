<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('code')->uinque();
            $table->integer('type_id');
            $table->integer('promotion_id');
            $table->string('hotel');
            $table->string('schedule');
            $table->date('date_to');
            $table->date('date_from');
            $table->string('name');
            $table->string('image');
            $table->integer('price');
            $table->integer('start_location_id');
            $table->integer('end_location_id');
            $table->integer('capacity');
            $table->integer('available_capacity');
            $table->integer('vehicle_id');
            $table->integer('status');
            $table->integer('description')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
