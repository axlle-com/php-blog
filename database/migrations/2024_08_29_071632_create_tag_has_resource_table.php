<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagHasResourceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_has_resource', function (Blueprint $table): void {
            $table->unsignedInteger('tag_id');
            $table->string('resource');
            $table->unsignedInteger('resource_id');

            $table->primary(['tag_id', 'resource', 'resource_id']);
            $table->foreign('tag_id', 'fk_tag_has_resource_tag1')->references('id')->on('tag')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_has_resource');
    }
}
