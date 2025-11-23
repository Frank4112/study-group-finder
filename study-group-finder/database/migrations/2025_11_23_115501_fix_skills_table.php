<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {

            if (Schema::hasColumn('skills', 'skill_name')) {
                $table->renameColumn('skill_name', 'name');
            }

            if (!Schema::hasColumn('skills', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {

            if (Schema::hasColumn('skills', 'name')) {
                $table->renameColumn('name', 'skill_name');
            }

            if (Schema::hasColumn('skills', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
