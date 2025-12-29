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
      Schema::create('event_media', function (Blueprint $table) {
    $table->id();

    $table->foreignId('event_id');

    $table->string('file_path');
    $table->enum('file_type', ['IMAGE', 'VIDEO']);

    $table->boolean('is_main')->default(false);
    $table->unsignedInteger('sort_order')->default(0);

    $table->foreignId('created_by')->nullable();

    $table->timestamps();
    $table->softDeletes();

    $table->index('event_id');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_media');
    }
};
