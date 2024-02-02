<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->foreignId('user_id');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreignId('accommodation_id');
            $table->foreign('accommodation_id')->on('accommodations')->references('id')->cascadeOnDelete();
            $table->foreignId('contract_id');
            $table->foreign('contract_id')->on('contracts')->references('id')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
