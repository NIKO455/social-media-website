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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username');
            $table->string('cover_path', 1024)->nullable();
            $table->string('avatar_path', 1024)->nullable();
            $table->longText('description')->nullable();
            $table->string('college',1024)->nullable();
            $table->string('school',1024)->nullable();
            $table->string('permanent_address',1024)->nullable();
            $table->string('current_address',1024)->nullable();
            $table->string('marital_status',1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username');
            $table->string('cover_path');
            $table->string('avatar_path');
            $table->longText('description');
            $table->string('college');
            $table->string('school');
            $table->string('permanent_address');
            $table->string('current_address');
            $table->string('marital_status');
        });
    }
};
