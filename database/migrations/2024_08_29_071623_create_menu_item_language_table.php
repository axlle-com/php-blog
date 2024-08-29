<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemLanguageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_item_language', function (Blueprint $table): void {
            $table->unsignedInteger('id')->unique('id_UNIQUE');
            $table->string('title');
            $table->string('language', 45);
            $table->unsignedInteger('menu_item_id');

            $table->primary(['id', 'menu_item_id']);
            $table->foreign('menu_item_id', 'fk_menu_item_language_menu_item1')->references('id')->on('menu_item')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_language');
    }
}
