<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('letter', function (Blueprint $table): void {
            $table->increments('id')->unique();
            $table->string('resource');
            $table->unsignedInteger('resource_id');
            $table->string('person');
            $table->integer('person_id');
            $table->string('subject')->nullable();
            $table->text('text')->nullable();
            $table->boolean('is_viewed')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter');
    }
}
