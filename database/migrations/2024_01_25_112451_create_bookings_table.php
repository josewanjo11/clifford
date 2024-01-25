<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->decimal('rates', 8);
            $table->string('clientName');
            $table->string('clientEmail');
            $table->string('clientPhone');
            $table->string('clientAddress');
            $table->string('rooms');
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->unsignedBigInteger('accommodation_id');
            $table->unsignedBigInteger('travel_agent_id');

            $table->decimal('totals', 8);
             $table->string('status')->default('active');
            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
           $table->foreign('travel_agent_id')->references('id')->on('travel_agents')->onDelete('cascade');
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
};
