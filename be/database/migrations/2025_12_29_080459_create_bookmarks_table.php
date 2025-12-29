<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');

            $table->foreignId('event_id');

            $table->timestamps();
            $table->softDeletes();

            // Không cho bookmark trùng
            $table->unique(['user_id', 'event_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};

