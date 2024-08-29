<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currency', function (Blueprint $table): void {
            $table->increments('id')->unique();
            $table->string('global_id', 50)->unique('global_id_UNIQUE');
            $table->integer('num_code')->unique('num_code_UNIQUE');
            $table->string('char_code', 45)->unique('char_code_UNIQUE');
            $table->string('title', 500);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency');
    }
}
