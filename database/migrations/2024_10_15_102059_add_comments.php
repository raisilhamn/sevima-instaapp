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
        // comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posts_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
