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
      Schema::create('comments', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id');

    $table->foreignId('event_id');

    $table->foreignId('parent_id')->nullable();

    $table->text('content')->nullable();
    $table->string('image_path')->nullable();

    $table->enum('reaction_type', [
        'LIKE',
        'LOVE',
        'SAD',
        'ANGRY'
    ])->nullable();

    $table->boolean('is_hidden')->default(false);
    $table->boolean('is_edited')->default(false);

    $table->string('ip_address', 45)->nullable();

    $table->timestamps();
    $table->softDeletes();

    $table->index(['event_id']);
    $table->index(['parent_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
