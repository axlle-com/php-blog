<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryHasResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_has_resource', function (Blueprint $table) {
            $table->unsignedInteger('gallery_id');
            $table->string('resource');
            $table->unsignedInteger('resource_id');
            
            $table->primary(['gallery_id', 'resource', 'resource_id']);
            $table->foreign('gallery_id', 'fk_gallery_has_resource_gallery1')->references('id')->on('gallery')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_has_resource');
    }
}
