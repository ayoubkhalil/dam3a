<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analysis_id')->constrained('bullying_analyses')->cascadeOnDelete();
            $table->string('report_number', 32)->unique();
            $table->text('summary')->nullable();
            $table->unsignedTinyInteger('severity')->nullable();
            $table->json('risks')->nullable();
            $table->json('recommendations')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};
