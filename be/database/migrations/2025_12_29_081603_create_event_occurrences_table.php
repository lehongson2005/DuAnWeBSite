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
       Schema::create('event_occurrences', function (Blueprint $table) {
    $table->id();

    $table->foreignId('event_id');

    $table->integer('year');

    // Kết quả convert
    $table->date('solar_date');

    // Lưu ngược lại để debug / verify
    $table->unsignedTinyInteger('lunar_day');
    $table->unsignedTinyInteger('lunar_month');
    $table->boolean('is_leap_month')->default(false);

    $table->string('timezone')->default('Asia/Ho_Chi_Minh');

    $table->timestamps();
    $table->softDeletes();

    // Index cực quan trọng
    $table->unique(['event_id', 'year', 'timezone']);
    $table->index(['solar_date']);
    $table->index(['year']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_occurrences');
    }
};
