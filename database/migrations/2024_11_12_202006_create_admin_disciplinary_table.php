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
        Schema::create('admin_disciplinary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->string('violation_level');
            $table->string('violation_header');
            $table->string('violation_offense')->default('First Offense');
            $table->text('violation_description');

            $table->date('date_of_incident')->nullable();
            $table->date('resolution_date')->nullable();
            $table->string('status')->default('pending');

            $table->text('action_taken')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_disciplinary');
    }
};
