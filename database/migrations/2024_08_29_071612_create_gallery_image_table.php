<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryImageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery_image', function (Blueprint $table): void {
            $table->increments('id')->unique();
            $table->unsignedInteger('gallery_id')->nullable();
            $table->string('original_name');
            $table->string('image')->unique('href_UNIQUE');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('gallery_id', 'fk_gallery_image_gallery1')->references('id')->on('gallery')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_image');
    }
}
