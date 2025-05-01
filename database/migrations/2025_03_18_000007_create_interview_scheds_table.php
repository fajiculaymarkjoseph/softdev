<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('interview_scheds', function (Blueprint $table) {
            $table->id('InterviewID');
            $table->unsignedBigInteger('InterviewerID');
            $table->string('modality');
            $table->dateTime('date_time');
            $table->string('room_number');
            $table->unsignedBigInteger('ApplicantsID');
            $table->string('Applicant_status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('InterviewerID')->references('InterviewerID')->on('interviewers')->onDelete('cascade');
            $table->foreign('ApplicantsID')->references('ApplicantsID')->on('applicants')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('interview_scheds');
    }
};
