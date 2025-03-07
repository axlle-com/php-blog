<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTokenTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_token', function (Blueprint $table): void {
            $table->increments('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('type', 45);
            $table->string('token', 300)->unique('token_UNIQUE');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->foreign('user_id', 'fk_user_token_user1')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_token');
    }
}
