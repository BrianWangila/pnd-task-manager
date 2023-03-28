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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId("department_id");
            $table->string("project_title");
            $table->dateTime("deadline")->nullable();
            $table->text("description");
            $table->enum("status", ['In progress', 'Completed', 'Overdue'])->default('In progress');
            $table->enum("priority", ['Normal', 'Urgent'])->default('Normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
