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
        Schema::create('subtasks', function (Blueprint $table) {
            
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('dueDate');
            $table->enum('status', ['to-do', 'complete', 'late'])->default('to-do');
            $table->foreignId('taskId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtasks');
    }
};
