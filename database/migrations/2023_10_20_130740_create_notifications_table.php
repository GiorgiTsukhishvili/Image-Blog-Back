<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('notifications', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
			$table->foreignId('creator_id')->references('id')->on('users')->cascadeOnDelete();
			$table->enum('type', ['comment', 'like', 'subscribed', 'post']);
			$table->boolean('is_new')->default(true);
			$table->foreignId('blog_id')->references('id')->on('blogs')->nullable()->cascadeOnDelete();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('notifications');
	}
};
