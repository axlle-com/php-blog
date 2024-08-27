<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('comment_id')->nullable();
            $table->string('resource')->index('resource');
            $table->unsignedInteger('resource_id')->index('resource_id');
            $table->string('person')->index('person');
            $table->integer('person_id')->index('person_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('is_viewed')->default(0);
            $table->unsignedSmallInteger('level')->default(1);
            $table->string('path', 500)->nullable()->index('path');
            $table->text('text');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
            $table->foreign('comment_id', 'fk_comment_comment1')->references('id')->on('comment')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
