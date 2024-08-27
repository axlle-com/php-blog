<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('first_name')->default('Undefined')->index('first_name');
            $table->string('last_name')->default('Undefined')->index('last_name');
            $table->string('patronymic')->nullable();
            $table->string('phone')->nullable()->unique('phone_UNIQUE');
            $table->string('email')->unique('email');
            $table->boolean('is_email')->default(0);
            $table->boolean('is_phone')->default(0);
            $table->smallInteger('status')->default(0);
            $table->string('avatar')->nullable();
            $table->string('password_hash');
            $table->rememberToken();
            $table->string('auth_token', 500)->nullable();
            $table->string('auth_key', 32)->nullable();
            $table->string('password_reset_token')->nullable()->unique('password_reset_token');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
