<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 200);
            $table->text('media_url');
            $table->enum('media_type', ['image', 'video', 'youtube', 'pdf', 'audio'])->default('image');
            $table->integer('duration_seconds')->default(15);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->foreignUuid('submitted_by')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('status');
            $table->index(['status', 'start_date', 'end_date']);
        });

        Schema::create('running_texts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text');
            $table->boolean('is_active')->default(true);
            $table->foreignUuid('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->index('is_active');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('running_texts');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('users');
    }
};
