<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('live_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('instructor_name');
            $table->datetime('scheduled_at');
            $table->integer('duration'); // en minutes
            $table->string('meeting_url')->nullable();
            $table->enum('target_audience', ['intern', 'entrepreneur', 'both']);
            $table->boolean('is_mandatory')->default(false);
            $table->integer('max_participants')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_sessions');
    }
};
