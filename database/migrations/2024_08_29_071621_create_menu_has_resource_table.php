<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuHasResourceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_has_resource', function (Blueprint $table): void {
            $table->unsignedInteger('menu_id');
            $table->string('resource');
            $table->unsignedInteger('resource_id');

            $table->primary(['menu_id', 'resource', 'resource_id']);
            $table->foreign('menu_id', 'fk_menu_has_resource_menu1')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_has_resource');
    }
}
