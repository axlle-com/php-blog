<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_message', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('telegram_message_id')->nullable();
            $table->unsignedInteger('telegram_user_id')->nullable();
            $table->unsignedInteger('message_id');
            $table->unsignedInteger('update_id')->nullable();
            $table->text('text')->nullable();
            $table->text('search')->nullable();
            $table->unsignedInteger('date')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
            ;
            $table->foreign('telegram_message_id', 'fk_telegram_message_telegram_message1')->references('id')->on('telegram_message')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('telegram_user_id', 'fk_telegram_message_telegram_user1')->references('id')->on('telegram_user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_message');
    }
}
