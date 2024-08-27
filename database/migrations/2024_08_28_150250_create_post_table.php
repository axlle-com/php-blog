<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('template_id')->nullable();
            $table->unsignedInteger('post_category_id')->nullable();
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('alias')->unique('alias_UNIQUE');
            $table->string('url', 500)->unique('url_UNIQUE');
            $table->boolean('is_published')->default(1);
            $table->boolean('is_favourites')->default(0);
            $table->boolean('has_comments')->default(0);
            $table->boolean('show_image_post')->default(1);
            $table->boolean('show_image_category')->default(1);
            $table->boolean('make_watermark')->default(1);
            $table->boolean('in_sitemap')->default(1);
            $table->string('media')->nullable();
            $table->string('title')->index('title');
            $table->string('title_short', 155)->nullable();
            $table->text('description')->nullable();
            $table->text('description_short')->nullable();
            $table->boolean('show_date')->default(1);
            $table->timestamp('date_pub')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('hits')->default(0);
            $table->integer('sort')->default(0);
            $table->float('stars', 1, 1)->unsigned()->default(0.0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('post_category_id', 'fk_post_post_category1')->references('id')->on('post_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('template_id', 'fk_post_render1')->references('id')->on('template')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
