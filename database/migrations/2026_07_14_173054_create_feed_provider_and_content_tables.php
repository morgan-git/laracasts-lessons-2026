<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feed_sources', function (Blueprint $table) {
            $table->id();
            $table->string('provider'); // reddit, youtube, rss etc
            $table->string('handle');   // foodporn, memes etc
            $table->string('display_name');
            $table->boolean('active')->default(true);
            $table->timestamp('last_fetched_at')->nullable();
            $table->timestamps();

            $table->unique(['provider', 'handle']); // no duplicate sources
        });

        Schema::create('feed_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feed_source_id')->constrained()->cascadeOnDelete();
            $table->string('external_id');  // t3_1efvf6q from reddit
            $table->string('title');
            $table->string('url');
            $table->string('author');
            $table->string('image_url')->nullable();
            $table->longText('content')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->timestamps();

            $table->unique(['feed_source_id', 'external_id']); // no duplicate posts per source
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feed_posts');
        Schema::dropIfExists('feed_sources');
    }
};
