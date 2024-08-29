<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoBlockHasResourceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_block_has_resource', function (Blueprint $table): void {
            $table->unsignedInteger('resource_id')->index('info_block_has_resource_resource_id');
            $table->string('resource')->index('info_block_has_resource_resource');
            $table->unsignedInteger('info_block_id');

            $table->foreign('info_block_id', 'fk_info_block_has_resource_info_block1')->references('id')->on('info_block')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_block_has_resource');
    }
}
