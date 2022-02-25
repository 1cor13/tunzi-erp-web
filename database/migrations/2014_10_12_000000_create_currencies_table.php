<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('rate')->nullable();
            $table->string('precision')->nullable();
            $table->string('symbol')->nullable();
            $table->string('symbol_position')->nullable();
            $table->string('decimal_mark')->nullable();
            $table->string('separate')->nullable();
            $table->string('status')->nullable();
            $table->string('default_currency')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
