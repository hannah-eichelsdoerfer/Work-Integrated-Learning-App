<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->text('description');
            $table
                ->integer('num_students_needed')
                ->min(3)
                ->max(6);
            $table
                ->integer('trimester')
                ->min(1)
                ->max(3);
            $table->integer('year')->default(date('Y'));
            $table->string('offering')->virtualAs('year || "-" || trimester');
            $table->foreignId('industry_partner_id')->constrained('industry_partners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
