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
            
            $table->enum('main_mastery', ['smartphones', 'tablets', 'desktops', 'laptops', 'smartwatches', 'cameras', 'printers', 'speakers', 'drones', 'all-in-one']);

            $table->boolean('smartphones')->default(false);
            $table->boolean('tablets')->default(false);
            $table->boolean('desktops')->default(false);
            $table->boolean('laptops')->default(false);
            $table->boolean('smartwatches')->default(false);
            $table->boolean('cameras')->default(false);
            $table->boolean('printers')->default(false);
            $table->boolean('speakers')->default(false);
            $table->boolean('drones')->default(false);
            $table->boolean('all-in-one')->default(false);
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
