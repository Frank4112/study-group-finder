<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_request_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['project_request_id', 'user_id']); // Ensure one like per user
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_request_likes');
    }
};

