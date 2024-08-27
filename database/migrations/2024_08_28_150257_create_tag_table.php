<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->boolean('in_sitemap')->default(1);
            $table->boolean('is_published')->default(1);
            $table->boolean('is_favourites')->default(0);
            $table->boolean('make_watermark')->default(1);
            $table->string('image')->nullable();
            $table->boolean('show_image')->default(1);
            $table->string('title')->unique('title_UNIQUE');
            $table->string('title_short', 150)->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag');
    }
}
