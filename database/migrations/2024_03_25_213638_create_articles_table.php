<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('url');
            $table->string('description')->nullable();
            $table->boolean('liked')->default(false); // corrected the method name
            $table->string('urlToImage')->nullable();
            $table->string('publishedAt')->nullable(); // corrected the method name
            $table->text('comments')->nullable(); // added comments column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
}
