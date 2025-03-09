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
        Schema::create('repairshop_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technician_id');
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('cascade');

            $table->string('shop_name');
            $table->string('shop_email');
            $table->timestamp('shop_email_verified_at')->nullable();
            
            $table->string('shop_contact');
            $table->string('shop_address');

            $table->string('shop_province');
            $table->string('shop_city');
            $table->string('shop_barangay');
            $table->string('shop_zip_code');

            $table->integer('shop_views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairshop_credentials');
    }
};
