<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('subject');               // e.g. "Laravel", "Math", "Biology"
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->text('description')->nullable(); // optional longer detail
            $table->string('location')->nullable();  // online / Nairobi / Eldoret etc.
            $table->dateTime('preferred_time')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_requests');
    }
};
