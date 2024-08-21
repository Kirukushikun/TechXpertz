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
        Schema::create('technician_notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('target_type',['technician', 'all'])->default('technician'); // Either 'technicians' or 'all'
            $table->foreignId('target_id')->nullable()->constrained('technicians')->onDelete('cascade'); // Nullable if 'all'
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_notifications');
    }
};
