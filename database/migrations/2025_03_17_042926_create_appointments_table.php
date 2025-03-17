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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('doctor_availability_id')->nullable();
            $table->date('date')->nullable();
            $table->enum('status', ['Pending','Confirmed','Cancelled'])->default('Pending');
            $table->foreign('doctor_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('patient_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('doctor_availability_id')->references('id')->on('doctor_availabilities')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
