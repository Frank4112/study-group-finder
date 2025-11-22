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
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('learning_style')->nullable();      // e.g. Visual, Auditory
        $table->string('preferred_mode')->nullable();      // Online, Physical, Hybrid
        $table->string('preferred_time_slot')->nullable(); // Mornings, Evenings, etc.
        $table->text('strengths')->nullable();             // topics they are good at
        $table->text('weaknesses')->nullable();            // topics they need help with
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('user_profiles');
}

};
