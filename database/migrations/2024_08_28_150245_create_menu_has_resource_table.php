<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuHasResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_has_resource', function (Blueprint $table) {
            $table->unsignedInteger('menu_id');
            $table->string('resource');
            $table->unsignedInteger('resource_id');
            
            $table->primary(['menu_id', 'resource', 'resource_id']);
            $table->foreign('menu_id', 'fk_menu_has_resource_menu1')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_has_resource');
    }
}
