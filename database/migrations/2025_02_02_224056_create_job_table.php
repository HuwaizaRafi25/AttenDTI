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
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->string('job_title', 255);
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained('job_type')->onDelete('cascade');
            $table->foreignId('qualification_id')->constrained('qualification')->onDelete('cascade');
            $table->foreignId('responbility_id')->constrained('responbility')->onDelete('cascade');
            $table->text('job_description')->nullable();
            $table->string('location', 255)->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};
