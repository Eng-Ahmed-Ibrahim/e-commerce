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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();  // Use UUID for primary key
            $table->string('type');  // Type of notification (e.g., class name)
            $table->morphs('notifiable');  // Notifiable entity (e.g., User)
            $table->json('data');  // JSON data for the notification
            $table->timestamp('read_at')->nullable();  // Timestamp for when the notification is read
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
