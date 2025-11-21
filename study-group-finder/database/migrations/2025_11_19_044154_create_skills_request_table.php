<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('skill_name');            // e.g. "PHP", "UI/UX", "Python"
            $table->enum('experience', ['none', 'basic', 'intermediate', 'advanced']);
            $table->text('details')->nullable();
            $table->boolean('is_urgent')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_requests');
    }
};
