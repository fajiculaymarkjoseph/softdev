<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('results', function (Blueprint $table) {
            $table->id('ResultID');
            $table->decimal('score', 5, 2);
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('results');
    }
};
