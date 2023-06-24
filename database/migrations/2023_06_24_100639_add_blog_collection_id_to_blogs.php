<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('blogs', function (Blueprint $table) {
			$table->foreignId('blog_collection_id')->constrained()->cascadeOnDelete();
		});
	}

	public function down(): void
	{
		Schema::table('blogs', function (Blueprint $table) {
			$table->dropColumn('blog_collection_id');
		});
	}
};
