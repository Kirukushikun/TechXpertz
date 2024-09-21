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

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->string('customer_fullname');           

            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('repairshop_appointments')->onDelete('cascade');

            $table->enum('status', ['pending', 'completed'])->default('pending');

            $table->enum('paid_status', ['Fully Paid', 'Initially Paid', 'Unpaid'])->default('Unpaid');
            $table->integer('revenue')->default(0);
            $table->integer('expenses')->default(0);
            
            $table->enum('repairstatus', ['Device Dropped Off', 'Diagnosis In Progress', 'Diagnosis Completed', 'Repair In Progress', 'Waiting For Parts', 'Repair Completed', 'Ready For Pickup', 'Device Collected'])->default('Device Dropped Off');
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
