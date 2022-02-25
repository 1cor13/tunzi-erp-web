<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('tax_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('reference')->nullable();
            $table->string('picture')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('currency_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
