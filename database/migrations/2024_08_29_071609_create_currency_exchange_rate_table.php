<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currency_exchange_rate', function (Blueprint $table): void {
            $table->unsignedInteger('id')->unique('id_UNIQUE');
            $table->unsignedInteger('currency_id');
            $table->decimal('value', 10, 4);
            $table->timestamp('date_rate');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id', 'currency_id']);
            $table->foreign('currency_id', 'fk_currency_exchange_rate_currency1')->references('id')->on('currency')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_exchange_rate');
    }
}
