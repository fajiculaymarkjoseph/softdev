<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('NotificationID');
            $table->unsignedBigInteger('DepartmentID');
            $table->dateTime('date_time');
            $table->string('modality');
            $table->unsignedBigInteger('StatusID');
            $table->timestamps();

            // Foreign key
            $table->foreign('StatusID')
            ->references('StatusID')
            ->on('status_updates')
            ->onDelete('cascade')
            ->deferrable()
            ->initiallyDeferred();
                });
    }

    public function down(): void {
        Schema::dropIfExists('notifications');
    }
};
