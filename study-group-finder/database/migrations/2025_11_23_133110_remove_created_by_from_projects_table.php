<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            // Drop foreign key if it exists
            if (Schema::hasColumn('projects', 'created_by')) {
                try {
                    $table->dropForeign(['created_by']);
                } catch (\Exception $e) {
                    // In case FK name is custom
                    $table->dropForeign('projects_created_by_foreign');
                }

                // Now drop the column
                $table->dropColumn('created_by');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            if (!Schema::hasColumn('projects', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();

                // Re-add FK
                $table->foreign('created_by')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');
            }
        });
    }
};
