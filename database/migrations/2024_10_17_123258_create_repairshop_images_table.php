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
        Schema::create('repairshop_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade'); 

            $table->enum('image_status', ['pending', 'active', 'deleted'])->default('active');
            $table->string('image_path');
            $table->string('image_type')->nullable();

            $table->boolean('is_primary')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairshop_images');
    }
};
