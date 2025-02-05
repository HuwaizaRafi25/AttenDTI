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
        Schema::create('pivot_responsibility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job')->onDelete('cascade');
            $table->foreignId('responsibility_id')->constrained('responsibility')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_responsibility');
    }
};
