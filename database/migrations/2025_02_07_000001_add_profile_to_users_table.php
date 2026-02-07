<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('alias')->nullable()->after('name');
            $table->unsignedTinyInteger('age')->nullable()->after('alias');
            $table->string('city')->nullable()->after('age');
            $table->string('school')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['alias', 'age', 'city', 'school']);
        });
    }
};
