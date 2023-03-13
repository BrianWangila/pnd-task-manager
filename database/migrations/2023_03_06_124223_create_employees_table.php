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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("department_id");
            $table->foreignId("user_id");
            $table->string("job_title");
            $table->enum("role", ["admin", "hod", "employee"])->default("employee");
            $table->string("organization")->default("Peak and Dale");
            $table->string("address");
            $table->string("phone");
            $table->string("country")->default("Kenya");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
