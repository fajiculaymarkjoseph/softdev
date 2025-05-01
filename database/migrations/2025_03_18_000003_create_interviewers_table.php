<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('interviewers', function (Blueprint $table) {
            $table->id('InterviewerID');
            $table->unsignedBigInteger('DepartmentID');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('interviewers');
    }
};
