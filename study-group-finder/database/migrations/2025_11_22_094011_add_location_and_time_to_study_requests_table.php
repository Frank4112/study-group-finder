<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('study_requests', function (Blueprint $table) {
            $table->string('location')->nullable()->after('description');
            $table->timestamp('preferred_time')->nullable()->after('location');
        });
    }

    public function down(): void
    {
        Schema::table('study_requests', function (Blueprint $table) {
            $table->dropColumn(['location', 'preferred_time']);
        });
    }
};
