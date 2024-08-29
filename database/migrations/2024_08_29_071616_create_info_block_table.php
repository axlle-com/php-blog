<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoBlockTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_block', function (Blueprint $table): void {
            $table->increments('id')->unique();
            $table->string('position', 45);
            $table->integer('sort')->default(0);
            $table->string('title')->index('title');
            $table->string('title_short', 155)->nullable();
            $table->text('description_short')->nullable();
            $table->text('description')->nullable();
            $table->boolean('make_watermark')->default(1);
            $table->string('media')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_block');
    }
}
