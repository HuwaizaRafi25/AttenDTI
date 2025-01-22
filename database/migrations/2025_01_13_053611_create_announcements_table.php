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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('announcement_category_id')->constrainted('announcement_categories')->onDelete('cascade');
            $table->string('title');
            $table->text('text');
            $table->string('image_path')->nullable();
            $table->string('link')->nullable();
            $table->boolean('remove_status')->default(false);
            $table->timestamps();

            $table->index(['created_by', 'announcement_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
