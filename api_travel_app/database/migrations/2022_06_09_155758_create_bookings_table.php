<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('tour_id');
            $table->integer('status');
            $table->integer('unit_price');
            $table->integer('total_price');
            $table->integer('is_confirmed');
            $table->dateTime('date_of_booking');
            $table->integer('is_paid');
            $table->integer('quantity');
            $table->dateTime('date_of_payment');
            $table->string('booking_details');
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
        Schema::dropIfExists('bookings');
    }
}
