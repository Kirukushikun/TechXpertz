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
        Schema::create('repairshop_repairstatus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            
            // Make customer_id nullable for walk-in repairs
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            
            $table->string('customer_fullname');           

            // Make appointment_id nullable for manual repairs
            $table->unsignedBigInteger('appointment_id')->nullable();

            $table->enum('status', ['pending','in progress', 'completed', 'terminated'])->default('pending');

            $table->enum('paid_status', ['Fully Paid', 'Initially Paid', 'Unpaid'])->default('Unpaid');
            $table->integer('revenue')->default(0);
            $table->integer('expenses')->default(0);
            
            $table->enum('repairstatus', ['Appointment Requested','Appointment Confirmed' ,'Device Dropped Off', 'Diagnosis In Progress', 'Diagnosis Completed', 'Repair In Progress', 'Waiting For Parts', 'Repair Completed', 'Ready For Pickup', 'Device Collected', 'Repair Terminated']);
            $table->string('repairstatus_conditional')->nullable();
            $table->text('repairstatus_message')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairshop_repairstatus');
    }
};
