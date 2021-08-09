<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('type_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->boolean('show_images')->default(true);
            $table->boolean('visible')->default(true)->index();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();
        });

        DB::statement("ALTER TABLE articles ADD FULLTEXT search(title, content)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
}
