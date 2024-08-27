<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('ip_id')->nullable();
            $table->string('resource');
            $table->unsignedInteger('resource_id');
            $table->string('event')->default('created');
            $table->text('body')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
            $table->foreign('ip_id', 'fk_history_ip1')->references('id')->on('ip')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_history_user1')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
}
