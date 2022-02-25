<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number')->nullable();
            $table->string('opening_balance')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_phone')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('default_account')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('currency_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
