<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('skill_requests', function (Blueprint $table) {

            // Ensure skill_name exists (string)
            if (Schema::hasColumn('skill_requests', 'skill')) {
                $table->renameColumn('skill', 'skill_name');
            }

            if (!Schema::hasColumn('skill_requests', 'skill_name')) {
                $table->string('skill_name');
            }

            // Experience field
            if (!Schema::hasColumn('skill_requests', 'experience')) {
                $table->string('experience')->nullable();
            }

            // Description field
            if (!Schema::hasColumn('skill_requests', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('skill_requests', function (Blueprint $table) {

            if (Schema::hasColumn('skill_requests', 'skill_name')) {
                $table->dropColumn('skill_name');
            }

            if (Schema::hasColumn('skill_requests', 'experience')) {
                $table->dropColumn('experience');
            }

            if (Schema::hasColumn('skill_requests', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
