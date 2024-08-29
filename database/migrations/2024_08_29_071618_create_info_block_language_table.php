<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoBlockLanguageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_block_language', function (Blueprint $table): void {
            $table->unsignedInteger('id')->unique('id_UNIQUE');
            $table->unsignedInteger('info_block_id');
            $table->string('language', 45);
            $table->string('title')->index('title');
            $table->string('title_short', 155)->nullable();
            $table->text('preview_description')->nullable();
            $table->text('description')->nullable();

            $table->primary(['id', 'info_block_id']);
            $table->foreign('info_block_id', 'fk_info_block_language_info_block1')->references('id')->on('info_block')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_block_language');
    }
}
