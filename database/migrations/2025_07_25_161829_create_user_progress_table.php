<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['not_started', 'in_progress', 'completed']);
            $table->integer('progress_percentage')->default(0);
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->json('quiz_scores')->nullable(); // Scores des quiz
            $table->json('assignment_submissions')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'module_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_progress');
    }
};
