<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('amount')->nullable();
            $table->string('date')->nullable();
            $table->text('description')->nullable();
            $table->string('pay_method')->nullable();
            $table->string('reference')->nullable();

            $table->unsignedBigInteger('account_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')
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
        Schema::dropIfExists('transfers');
    }
}
