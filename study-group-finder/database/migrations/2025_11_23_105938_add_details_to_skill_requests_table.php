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
        // Only modify table if it exists
        if (Schema::hasTable('skill_requests')) {
            Schema::table('skill_requests', function (Blueprint $table) {
                // Only add 'details' if it doesn't exist
                if (!Schema::hasColumn('skill_requests', 'details')) {
                    $table->text('details')->nullable()->after('experience');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('skill_requests')) {
            Schema::table('skill_requests', function (Blueprint $table) {
                if (Schema::hasColumn('skill_requests', 'details')) {
                    $table->dropColumn('details');
                }
            });
        }
    }
};