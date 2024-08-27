<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 45)->unique('key_UNIQUE');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('value_string', 1000)->nullable();
            $table->longText('value_text')->nullable();
            $table->text('value_json')->nullable();
            $table->smallInteger('value_bool')->default(0);
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
        Schema::dropIfExists('setting');
    }
}
