<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_item', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('menu_item_id')->nullable();
            $table->string('resource')->nullable();
            $table->unsignedInteger('resource_id')->nullable();
            $table->string('title');
            $table->integer('sort')->default(0);
            $table->string('url');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
            $table->foreign('menu_id', 'fk_menu_item_menu1')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_item_id', 'fk_menu_item_menu_item1')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_item');
    }
}
