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
            $table->dateTime("deadline")->nullable();
            $table->text("description");
            $table->integer("project_id");
            $table->integer("employee_id")->nullable();
            $table->boolean("is_complete")->default(false);
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
