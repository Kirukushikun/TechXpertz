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
        Schema::create('admin_activitylogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('action');
            $table->text('description');
            $table->string('status')->default('success');
            $table->string('ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_activitylogs');
    }
};
