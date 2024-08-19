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
        Schema::create('repairshop_mastery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');
            
            $table->enum('main_mastery', ['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One']);

            $table->boolean('Smartphone')->default(false);
            $table->boolean('Tablet')->default(false);
            $table->boolean('Desktop')->default(false);
            $table->boolean('Laptop')->default(false);
            $table->boolean('Smartwatch')->default(false);
            $table->boolean('Camera')->default(false);
            $table->boolean('Printer')->default(false);
            $table->boolean('Speaker')->default(false);
            $table->boolean('Drone')->default(false);
            $table->boolean('All-In-One')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairshop_mastery');
    }
};
