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
        Schema::table('skill_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('skill_requests', 'experience')) {
                $table->string('experience')->nullable()->after('skill_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('skill_requests', function (Blueprint $table) {
            if (Schema::hasColumn('skill_requests', 'experience')) {
                $table->dropColumn('experience');
            }
        });
    }
};