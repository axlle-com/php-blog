<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoryHasInfoBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_category_has_info_block', function (Blueprint $table) {
            $table->unsignedInteger('post_category_id');
            $table->unsignedInteger('info_block_id');
            $table->integer('sort')->default(0);
            
            $table->primary(['post_category_id', 'info_block_id']);
            $table->foreign('info_block_id', 'fk_post_category_has_info_block_info_block1')->references('id')->on('info_block')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_category_id', 'fk_post_category_has_info_block_post_category1')->references('id')->on('post_category')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_category_has_info_block');
    }
}
