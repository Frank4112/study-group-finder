<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('study_requests', function (Blueprint $table) {
            // Add 'location' only if it does not exist
            if (!Schema::hasColumn('study_requests', 'location')) {
                $table->string('location')->nullable()->after('description');
            }

            // Add 'preferred_time' only if it does not exist
            if (!Schema::hasColumn('study_requests', 'preferred_time')) {
                $table->dateTime('preferred_time')->nullable()->after('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('study_requests', function (Blueprint $table) {
            // Drop columns only if they exist
            if (Schema::hasColumn('study_requests', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('study_requests', 'preferred_time')) {
                $table->dropColumn('preferred_time');
            }
        });
    }
};
