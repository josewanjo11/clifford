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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            // Define fields for contract rates, start date, end date, and relationships
            $table->decimal('contract_rate', 8, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('accommodation_id');
            $table->unsignedBigInteger('travel_agent_id');
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
        Schema::dropIfExists('contracts');
    }
};
