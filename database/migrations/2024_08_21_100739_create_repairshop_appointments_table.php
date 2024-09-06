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
            $table->unsignedBigInteger('customer_id');

            $table->enum('status', ['confirmed', 'requested', 'completed', 'rejected'])->default('requested');

            $table->string('fullname');
            $table->string('email');
            $table->string('contact_no');
            
            $table->string('device_type');
            $table->string('device_brand');
            $table->string('device_model');
            $table->string('device_serial')->nullable();
            
            $table->text('issue_descriptions')->nullable();
            $table->string('error_message')->nullable();
            $table->string('repair_attempts')->nullable();
            $table->string('recent_events')->nullable();
            $table->string('prepared_parts')->nullable();

            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('appointment_urgency')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
