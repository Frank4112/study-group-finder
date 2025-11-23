<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skill_requests', function (Blueprint $table) {
            // Add 'description' column if missing
            if (!Schema::hasColumn('skill_requests', 'description')) {
                $table->text('description')->nullable()->after('experience');
            }

            // Add 'is_urgent' column if missing
            if (!Schema::hasColumn('skill_requests', 'is_urgent')) {
                $table->boolean('is_urgent')->default(false)->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('skill_requests', function (Blueprint $table) {
            if (Schema::hasColumn('skill_requests', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('skill_requests', 'is_urgent')) {
                $table->dropColumn('is_urgent');
            }
        });
    }
};
