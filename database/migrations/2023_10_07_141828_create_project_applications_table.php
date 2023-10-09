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
        Schema::create('project_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('student_id')->constrained('students');
            $table->text('justification');
            // pending, accepted, rejected
            $table->string('status')->default('pending')->in_array(['pending', 'accepted', 'rejected']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_applications');
    }
};
