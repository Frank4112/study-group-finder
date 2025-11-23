<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('study_requests')) {
            Schema::table('study_requests', function (Blueprint $table) {
                if (!Schema::hasColumn('study_requests', 'course')) {
                    $table->string('course')->nullable()->after('subject');
                }
                if (!Schema::hasColumn('study_requests', 'level')) {
                    $table->string('level')->nullable()->after('course');
                }
                if (!Schema::hasColumn('study_requests', 'location')) {
                    $table->string('location')->nullable()->after('description');
                }
                if (!Schema::hasColumn('study_requests', 'preferred_time')) {
                    $table->timestamp('preferred_time')->nullable()->after('location');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('study_requests')) {
            Schema::table('study_requests', function (Blueprint $table) {
                if (Schema::hasColumn('study_requests', 'course')) {
                    $table->dropColumn('course');
                }
                if (Schema::hasColumn('study_requests', 'level')) {
                    $table->dropColumn('level');
                }
                if (Schema::hasColumn('study_requests', 'location')) {
                    $table->dropColumn('location');
                }
                if (Schema::hasColumn('study_requests', 'preferred_time')) {
                    $table->dropColumn('preferred_time');
                }
            });
        }
    }
};
