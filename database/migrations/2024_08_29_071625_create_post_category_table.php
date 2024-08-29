<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_category', function (Blueprint $table): void {
            $table->increments('id')->unique();
            $table->unsignedInteger('template_id')->nullable();
            $table->unsignedInteger('post_category_id')->nullable();
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('alias')->unique('alias_UNIQUE');
            $table->string('url', 500)->unique('url_UNIQUE');
            $table->boolean('is_published')->default(1);
            $table->boolean('is_favourites')->default(0);
            $table->boolean('make_watermark')->default(1);
            $table->boolean('in_sitemap')->default(1);
            $table->string('image')->nullable();
            $table->boolean('show_image')->default(1);
            $table->string('title')->index('title');
            $table->string('title_short', 150)->nullable();
            $table->text('description')->nullable();
            $table->text('preview_description')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('post_category_id', 'fk_post_category_post_category1')->references('id')->on('post_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('template_id', 'fk_post_category_render1')->references('id')->on('template')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_category');
    }
}
