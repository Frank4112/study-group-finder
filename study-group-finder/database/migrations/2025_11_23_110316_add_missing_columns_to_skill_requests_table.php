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
        if (Schema::hasTable('skill_requests')) {
            Schema::table('skill_requests', function (Blueprint $table) {
                if (!Schema::hasColumn('skill_requests', 'experience')) {
                    $table->string('experience')->nullable()->after('skill_name');
                }
                if (!Schema::hasColumn('skill_requests', 'details')) {
                    $table->text('details')->nullable()->after('experience');
                }
                if (!Schema::hasColumn('skill_requests', 'is_urgent')) {
                    $table->boolean('is_urgent')->default(false)->after('details');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('skill_requests')) {
            Schema::table('skill_requests', function (Blueprint $table) {
                if (Schema::hasColumn('skill_requests', 'experience')) {
                    $table->dropColumn('experience');
                }
                if (Schema::hasColumn('skill_requests', 'details')) {
                    $table->dropColumn('details');
                }
                if (Schema::hasColumn('skill_requests', 'is_urgent')) {
                    $table->dropColumn('is_urgent');
                }
            });
        }
    }
};