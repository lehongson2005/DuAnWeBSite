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
    $table->id();

    $table->foreignId('user_id');

    $table->foreignId('event_id')->nullable();

    $table->enum('type', ['SYSTEM', 'EVENT'])->default('SYSTEM');

    $table->string('title');
    $table->text('message');

    $table->json('data')->nullable();

    $table->timestamp('scheduled_at')->nullable();
    $table->timestamp('read_at')->nullable();

    $table->boolean('is_sent')->default(false);

    $table->timestamps();

    $table->index(['user_id']);
    $table->index(['read_at']);
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
