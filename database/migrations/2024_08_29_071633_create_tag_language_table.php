<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagLanguageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_language', function (Blueprint $table): void {
            $table->unsignedInteger('id')->unique('id_UNIQUE');
            $table->unsignedInteger('tag_id');
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('language', 45);
            $table->string('title')->unique('title_UNIQUE');
            $table->string('title_short', 150)->nullable();
            $table->text('description')->nullable();

            $table->primary(['id', 'tag_id']);
            $table->foreign('tag_id', 'fk_tag_language_tag1')->references('id')->on('tag')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_language');
    }
}
