<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('study_groups', function (Blueprint $table) {
        $table->foreignId('study_request_id')
            ->nullable()
            ->constrained('study_requests')
            ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('study_groups', function (Blueprint $table) {
        $table->dropForeign(['study_request_id']);
        $table->dropColumn('study_request_id');
    });
}
};