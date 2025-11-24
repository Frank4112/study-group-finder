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
    Schema::create('project_join_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('project_request_id');
        $table->unsignedBigInteger('user_id');
        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
        $table->timestamps();

        $table->foreign('project_request_id')->references('id')->on('project_requests')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

};
