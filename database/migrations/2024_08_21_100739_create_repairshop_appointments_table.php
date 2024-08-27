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
        Schema::create('repairshop_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->enum('status', ['confirmed', 'requested', 'completed', 'rejected'])->default('request');
            //Confirmed Appointments , Rejected Appointments

            $table->string('fullname'); // Full name of the customer
            $table->string('email'); // Email of the customer
            $table->string('contact_no'); // Contact number of the customer
            
            // Device Information
            $table->string('device_type');
            $table->string('device_brand');
            $table->string('device_model');
            $table->string('device_serial')->nullable(); // Nullable field
            
            // Device Issue
            $table->text('issue_descriptions')->nullable(); // Using text for potentially longer descriptions
            $table->string('error_messages')->nullable();
            $table->string('repair_attempts')->nullable();
            $table->string('recent_events')->nullable();
            $table->string('prepared_parts')->nullable();

            // Appointment Schedule
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('appointment_urgency')->nullable(); // Urgency level of the appointment

            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairshop_appointments');
    }
};
