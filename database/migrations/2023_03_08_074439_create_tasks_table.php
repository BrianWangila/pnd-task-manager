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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string("task_title");
            $table->date("deadline")->nullable();
            $table->text("description");
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId("employee_id")->nullable();
            $table->enum('status', ['In progress', 'Completed', 'Overdue'])->default('In progress');
            $table->boolean("reminder")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
