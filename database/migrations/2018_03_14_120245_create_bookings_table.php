<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('delegate_name');
            $table->string('delegate_email');
            $table->string('delegate_type')->nullable();;              
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('pass_id')->unsigned();
            $table->foreign('pass_id')->references('id')->on('passes')->onDelete('cascade');
            $table->string('purchase_source')->nullable();;
            $table->string('purchase_reference')->nullable();;
            $table->string('hotel')->nullable();;
            $table->integer('amount_paid')->nullable();;
            $table->boolean('is_checked_in')->nullable();;
            $table->string('checked_in_by');
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
