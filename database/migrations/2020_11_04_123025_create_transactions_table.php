<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('revenue_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('revenue_id')->references('id')->on('revenues')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('transactions');
    }
}
