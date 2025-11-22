<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('study_group_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('study_group_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('study_group_id')
                  ->references('id')
                  ->on('study_groups')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('study_group_members');
    }
};
    