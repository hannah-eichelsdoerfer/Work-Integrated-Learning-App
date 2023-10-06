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
        Schema::create('industry_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // Add other teacher-specific columns here
            $table->string('approved')->default('pending');
            $table->timestamps();
            // Define the foreign key relationship 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_partners');
    }
};
