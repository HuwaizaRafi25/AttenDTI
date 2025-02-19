`<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('itb_account')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->boolean('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_pic')->nullable();
            $table->date('period_start_date')->nullable();
            $table->date('period_end_date')->nullable();
            $table->string('major')->nullable();
            $table->string('institution')->nullable();
            $table->foreignId('placement_id')->nullable()->constrained('locations')->onDelete('cascade');
            $table->dateTime('last_seen')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['identity_number', 'itb_account', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
