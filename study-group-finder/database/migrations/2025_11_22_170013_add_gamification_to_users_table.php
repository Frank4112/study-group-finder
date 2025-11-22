<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'points')) {
                $table->integer('points')->unsigned()->default(0);
            }

            if (!Schema::hasColumn('users', 'xp_level')) {
                $table->integer('xp_level')->unsigned()->default(1);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'points')) {
                $table->dropColumn('points');
            }
            if (Schema::hasColumn('users', 'xp_level')) {
                $table->dropColumn('xp_level');
            }
        });
    }
};
