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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('document_type_id')->constrained('document_types')->onDelete('cascade');
            $table->foreignId('document_category_id')->constrained('document_categories')->onDelete('cascade');
            $table->string('document_number');
            $table->string('document_subject');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->bigInteger('file_size');
            $table->text('description')->nullable();
            $table->boolean('remove_status')->default(false);
            $table->timestamps();

            $table->index(['created_by', 'document_type_id', 'document_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
