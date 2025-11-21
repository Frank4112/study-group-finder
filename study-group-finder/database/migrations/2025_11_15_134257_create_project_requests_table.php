<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title');                  // e.g. "Build a Study Group App"
            $table->text('description')->nullable();  // longer project description
            $table->string('required_skills')->nullable(); // e.g. "Laravel, Vue.js, MySQL"
            $table->enum('status', ['open', 'closed'])->default('open');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_requests');
    }
};

