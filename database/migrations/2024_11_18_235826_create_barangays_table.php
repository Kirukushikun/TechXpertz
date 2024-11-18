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
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Barangay name
            $table->string('code')->unique(); // PSGC Code
            $table->string('city_code')->nullable(); // Foreign key for cities
            $table->string('municipality_code')->nullable(); // Foreign key for municipalities
            $table->string('province_code'); // Foreign key for provinces
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangays');
    }
};
