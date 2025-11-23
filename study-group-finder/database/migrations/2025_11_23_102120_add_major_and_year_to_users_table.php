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
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'major')) {
            $table->string('major')->nullable()->after('password');
        }
        if (!Schema::hasColumn('users', 'year_of_study')) {
            $table->integer('year_of_study')->default(0)->after('major');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'major')) {
            $table->dropColumn('major');
        }
        if (Schema::hasColumn('users', 'year_of_study')) {
            $table->dropColumn('year_of_study');
        }
    });
}
};
