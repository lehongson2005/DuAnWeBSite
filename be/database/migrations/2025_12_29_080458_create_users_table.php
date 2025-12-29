<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            
            // Socialite fields
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->nullable();

            $table->rememberToken();

            // Trạng thái tài khoản
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'BANNED'])
                  ->default('ACTIVE');

            // Xác thực & theo dõi
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();

            // Optimistic lock
            $table->unsignedInteger('version')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

