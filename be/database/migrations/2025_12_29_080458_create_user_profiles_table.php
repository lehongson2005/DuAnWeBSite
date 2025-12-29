<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');

            $table->string('full_name');
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            // Thông tin cá nhân
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->date('birthday')->nullable();

            $table->text('bio')->nullable();

            // Cá nhân hoá
            $table->json('preferences')->nullable();
            $table->json('settings')->nullable();

            // Quốc tế hoá
            $table->string('locale')->default('vi');
            $table->string('timezone')->default('Asia/Ho_Chi_Minh');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

