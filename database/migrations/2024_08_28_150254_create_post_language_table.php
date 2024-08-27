<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_language', function (Blueprint $table) {
            $table->unsignedInteger('id')->unique('id_UNIQUE');
            $table->unsignedInteger('post_id');
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('language', 45);
            $table->string('title')->index('title');
            $table->string('title_short', 155)->nullable();
            $table->text('preview_description')->nullable();
            $table->text('description')->nullable();
            
            $table->primary(['id', 'post_id']);
            $table->foreign('post_id', 'fk_post_language_post1')->references('id')->on('post')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_language');
    }
}
