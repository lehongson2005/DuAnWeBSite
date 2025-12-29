<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Quan hệ
            $table->foreignId('category_id');

            $table->foreignId('region_id')->nullable();

            $table->foreignId('created_by');

            // Nội dung
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary', 500)->nullable();
            $table->longText('content')->nullable();

            // Định nghĩa ngày (KHÔNG chứa năm)
            $table->enum('date_type', ['SOLAR', 'LUNAR']);
            $table->unsignedTinyInteger('day');
            $table->unsignedTinyInteger('month');
            $table->boolean('is_leap_month')->default(false);

            // Metadata
            $table->unsignedInteger('priority')->default(0);
            $table->unsignedBigInteger('view_count')->default(0);

            $table->enum('status', ['DRAFT', 'PUBLISHED', 'ARCHIVED'])
                  ->default('DRAFT');

            $table->timestamps();
            $table->softDeletes();

            // Index tối ưu truy vấn
            $table->index(['date_type', 'month', 'day']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
