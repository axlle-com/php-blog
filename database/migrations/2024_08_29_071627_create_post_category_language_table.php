<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoryLanguageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_category_language', function (Blueprint $table): void {
            $table->unsignedInteger('id')->unique('id_UNIQUE');
            $table->unsignedInteger('post_category_id');
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('language', 45);
            $table->string('title')->index('title');
            $table->string('title_short', 150)->nullable();
            $table->text('description')->nullable();
            $table->text('preview_description')->nullable();

            $table->primary(['id', 'post_category_id']);
            $table->foreign('post_category_id', 'fk_post_category_language_post_category1')->references('id')->on('post_category')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_category_language');
    }
}
