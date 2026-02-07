<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bullying_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id', 64)->nullable()->index();
            $table->string('alias')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('city')->nullable();
            $table->string('school')->nullable();
            $table->text('incident_text');
            $table->string('type', 50)->nullable(); // racism, sexism, cyberbullying, etc.
            $table->unsignedTinyInteger('severity')->nullable(); // 1-4
            $table->json('risk_indicators')->nullable();
            $table->string('recommended_action', 100)->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bullying_analyses');
    }
};
