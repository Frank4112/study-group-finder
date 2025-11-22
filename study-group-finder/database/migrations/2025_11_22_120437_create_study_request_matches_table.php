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
    Schema::create('study_request_matches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('study_request_id')->constrained()->onDelete('cascade');
        $table->foreignId('requester_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
        $table->unsignedInteger('score')->default(0);
        $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('study_request_matches');
}
};