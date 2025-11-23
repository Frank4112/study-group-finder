<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skill_requests', function (Blueprint $table) {

            // Ensure skill_name exists
            if (!Schema::hasColumn('skill_requests', 'skill_name')) {
                $table->string('skill_name')->after('user_id');
            }

            // Ensure experience exists
            if (!Schema::hasColumn('skill_requests', 'experience')) {
                $table->string('experience')->nullable()->after('skill_name');
            }

            // NEW FIELD: details
            if (!Schema::hasColumn('skill_requests', 'details')) {
                $table->text('details')->nullable()->after('experience');
            }

            // NEW FIELD: is_urgent
            if (!Schema::hasColumn('skill_requests', 'is_urgent')) {
                $table->boolean('is_urgent')->default(0)->after('details');
            }

            // Ensure description exists
            if (!Schema::hasColumn('skill_requests', 'description')) {
                $table->text('description')->nullable()->after('is_urgent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('skill_requests', function (Blueprint $table) {
            // Undo added fields only
            if (Schema::hasColumn('skill_requests', 'details')) {
                $table->dropColumn('details');
            }
            if (Schema::hasColumn('skill_requests', 'is_urgent')) {
                $table->dropColumn('is_urgent');
            }
        });
    }
};
