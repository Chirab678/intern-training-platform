<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('content')->nullable();
            $table->integer('month'); // 1, 2, ou 3
            $table->integer('order');
            $table->enum('target_audience', ['intern', 'entrepreneur', 'both']);
            $table->boolean('is_mandatory')->default(true);
            $table->integer('estimated_duration'); // en minutes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modules');
    }
};
