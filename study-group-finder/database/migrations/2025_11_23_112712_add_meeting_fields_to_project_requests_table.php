<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_requests', function (Blueprint $table) {
            $table->unsignedInteger('max_members')->nullable()->after('required_skills');
            $table->string('location')->nullable()->after('max_members');
            $table->time('meeting_time')->nullable()->after('location');
        });
    }

    public function down(): void
    {
        Schema::table('project_requests', function (Blueprint $table) {
            $table->dropColumn(['max_members', 'location', 'meeting_time']);
        });
    }
};
